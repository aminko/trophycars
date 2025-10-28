import axios from 'axios';

const api = axios.create({
    baseURL: '/api',
});

// Response interceptor for global error handling
api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response) {
            // Server responded with error status
            console.error('API Error:', error.response.status, error.response.data);
        } else if (error.request) {
            // Request was made but no response
            console.error('Network Error:', error.request);
        } else {
            // Something else happened
            console.error('Request Error:', error.message);
        }
        return Promise.reject(error);
    }
);

export const getUser = (userId) => api.get(`/v1/users/${userId}`);

export const getVehicles = (params = {}) => api.get('/v1/vehicles', { params });

export const purchaseVehicle = (userId, vehicleId) => api.post('/v1/gamestore/vehicles', { userId, vehicleId });