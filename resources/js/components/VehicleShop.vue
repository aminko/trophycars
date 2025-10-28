<template>
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Vehicle Shop</h2>
    <div v-if="loading" class="text-center">Loading vehicles...</div>
    <div v-else-if="error" class="text-red-500">{{ error }}</div>
    <div v-else>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <VehicleCard
          v-for="vehicle in vehicles"
          :key="vehicle.id"
          :vehicle="vehicle"
          :user-cash="userCash"
          :user-id="userId"
          @purchase-success="$emit('purchase-success')"
        />
      </div>
      <div class="flex justify-between items-center">
        <button
          @click="loadPrev"
          :disabled="!links?.previous_page || paginationLoading"
          class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
        >
          Previous
        </button>
        <span class="text-gray-700">
          Vehicles ({{ meta?.count || 0 }} shown)
        </span>
        <button
          @click="loadNext"
          :disabled="!links?.next_page || paginationLoading"
          class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, shallowRef, onMounted } from 'vue';
import { getVehicles } from '../api.js';
import VehicleCard from './VehicleCard.vue';

export default {
  name: 'VehicleShop',
  components: {
    VehicleCard,
  },
  props: {
    userCash: {
      type: Number,
      required: true,
    },
    userId: {
      type: Number,
      required: true,
    },
  },
  emits: ['purchase-success'],
  setup() {
    const vehicles = shallowRef([]);
    const meta = ref({ count: 0, has_more: false });
    const links = ref({ previous_page: null, next_page: null });
    const loading = ref(true);
    const error = ref(null);
    const paginationLoading = ref(false);

    const fetchVehicles = async (cursor = null) => {
      loading.value = true;
      error.value = null;
      try {
        const params = { per_page: 10 };
        if (cursor) params.cursor = cursor;
        const response = await getVehicles(params);
        vehicles.value = response.data.data;
        meta.value = response.data.meta;
        links.value = response.data.links;
      } catch (err) {
        error.value = 'Failed to load vehicles';
        console.error(err);
      } finally {
        loading.value = false;
      }
    };

    const loadNext = () => {
      if (links.value.next_page && !paginationLoading.value) {
        paginationLoading.value = true;
        const url = new URL(links.value.next_page);
        const cursor = url.searchParams.get('cursor');
        fetchVehicles(cursor).finally(() => paginationLoading.value = false);
      }
    };

    const loadPrev = () => {
      if (links.value.previous_page && !paginationLoading.value) {
        paginationLoading.value = true;
        const url = new URL(links.value.previous_page);
        const cursor = url.searchParams.get('cursor');
        fetchVehicles(cursor).finally(() => paginationLoading.value = false);
      }
    };

    onMounted(() => fetchVehicles());

    return {
      vehicles,
      meta,
      links,
      loading,
      error,
      paginationLoading,
      loadNext,
      loadPrev,
    };
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>