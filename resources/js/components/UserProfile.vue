<template>
  <div class="bg-white p-6 rounded-lg shadow-md mb-6">
    <h2 class="text-2xl font-bold mb-4">User Profile</h2>
    <div v-if="loading" class="text-center">Loading...</div>
    <div v-else-if="error" class="text-red-500">{{ error }}</div>
    <div v-else-if="user">
      <div class="mb-4">
        <p class="text-lg"><strong>Name:</strong> {{ user.name }}</p>
        <p class="text-lg"><strong>Cash:</strong> ${{ user.cash }}</p>
      </div>
      <div>
        <h3 class="text-xl font-semibold mb-2">Owned Cars</h3>
        <ul v-if="user.ownedCars.length" class="list-disc list-inside">
          <li v-for="car in user.ownedCars" :key="car.id" class="text-gray-700">
            {{ car.name }} ({{ car.type }})
          </li>
        </ul>
        <p v-else class="text-gray-500">No cars owned yet.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserProfile',
  props: {
    user: {
      type: Object,
      default: null,
    },
    loading: {
      type: Boolean,
      default: false,
    },
    error: {
      type: String,
      default: null,
    },
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>