<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl text-amber-500 font-bold text-center mb-8">
            Trophy Cars Game Store
        </h1>
        <UserProfile :user="user" :loading="loading" :error="error" />
        <VehicleShop
            :user-cash="user?.cash || 0"
            :user-id="user?.id || 1"
            @purchase-success="refreshUser"
        />
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import UserProfile from "./components/UserProfile.vue";
import VehicleShop from "./components/VehicleShop.vue";
import { getUser } from "./api.js";

export default {
    name: "App",
    components: {
        UserProfile,
        VehicleShop,
    },
    setup() {
        const user = ref(null);
        const loading = ref(true);
        const error = ref(null);

        const refreshUser = async () => {
            loading.value = true;
            error.value = null;
            try {
                const response = await getUser(user.value?.id || 1);
                user.value = response.data.data;
            } catch (err) {
                error.value = "Failed to load user data";
                console.error(err);
            } finally {
                loading.value = false;
            }
        };

        onMounted(refreshUser);

        return {
            user,
            loading,
            error,
            refreshUser,
        };
    },
};
</script>

<style>
/* Global styles if needed */
</style>
