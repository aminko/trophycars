<template>
    <div class="bg-white p-4 rounded-lg shadow-md border">
        <h3 class="text-xl font-semibold mb-2">{{ vehicle.name }}</h3>
        <p class="text-gray-600 mb-2">Type: {{ vehicle.type }}</p>
        <p class="text-lg font-bold text-green-600 mb-4">
            Price: ${{ vehicle.price }}
        </p>
        <button
            @click="handlePurchase"
            :disabled="purchasing || !canAfford"
            class="w-full py-2 px-4 rounded bg-blue-500 text-white hover:bg-blue-600 disabled:bg-gray-400 disabled:cursor-not-allowed"
        >
            {{
                purchasing
                    ? "Purchasing..."
                    : canAfford
                      ? "Buy Now"
                      : "Cannot Afford"
            }}
        </button>
    </div>
</template>

<script>
import { ref, computed } from "vue";
import { purchaseVehicle } from "../api.js";
import { toast } from "vue3-toastify";

export default {
    name: "VehicleCard",
    props: {
        vehicle: {
            type: Object,
            required: true,
            validator: (value) => {
                return value && typeof value.id === 'number' &&
                       typeof value.name === 'string' &&
                       typeof value.price === 'number' &&
                       typeof value.type === 'string';
            },
        },
        userCash: {
            type: Number,
            required: true,
        },
        userId: {
            type: Number,
            required: true,
        },
    },
    emits: ["purchase-success"],
    setup(props, { emit }) {
        const purchasing = ref(false);

        const canAfford = computed(() => props.userCash >= props.vehicle.price);

        const handlePurchase = async () => {
            if (!canAfford.value || purchasing.value) return;

            purchasing.value = true;
            try {
                await purchaseVehicle(props.userId, props.vehicle.id);
                emit("purchase-success");
                toast.success("Purchase successful!");
            } catch (err) {
                let message = "Purchase failed. Please try again.";
                if (err.response && err.response.status === 409) {
                    message = "Vehicle already owned.";
                }
                toast.error(message);
                console.error(err);
            } finally {
                purchasing.value = false;
            }
        };

        return {
            purchasing,
            canAfford,
            handlePurchase,
        };
    },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
