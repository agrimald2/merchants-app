<template>
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-11/12 max-w-2xl">
            <div class="p-4 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">{{ address }}</h2>
                    <button class="text-black" @click="closeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <iframe :src="url" width="800" height="600" style="border:0;" allowfullscreen="true" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" allow="geolocation"></iframe>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        latitude: {
            type: Number,
            required: true
        },
        longitude: {
            type: Number,
            required: true
        },
        address: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            showModal: false,
            url: `https://www.google.com/maps/embed/v1/place?key=AIzaSyD838-bKnRCBtmc2HgdkxH-GvykXOhUKWI&q=${this.latitude},${this.longitude}`
        };
    },
    mounted() {
    },
    methods: {
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            this.$emit('close');
        },
    }
};
</script>

<style scoped>
iframe {
    max-width: 100%;
    height: auto;
}
</style>