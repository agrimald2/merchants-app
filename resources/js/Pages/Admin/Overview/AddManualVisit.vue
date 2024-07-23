<template>
    <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Añadir Visita Manual
                            </h3>
                            <div class="mt-2">
                                <form @submit.prevent="handleSubmit">
                                    <div v-if="loading" class="flex justify-center mb-4">
                                        <LoaderModal />
                                    </div>
                                    <div v-else>
                                        <div class="mb-4">
                                            <label for="merchant" class="block text-sm font-medium text-gray-700">Buscar
                                                Mercaderista</label>
                                            <div class="relative">
                                                <input type="text" v-model="merchantSearch" @input="filterMerchants"
                                                    placeholder="Seleccionar Mercaderista"
                                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" />
                                                <ul v-if="merchantSearch && filteredMerchants.length"
                                                    class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
                                                    <li v-for="merchant in filteredMerchants" :key="merchant.id"
                                                        @click="selectMerchant(merchant)"
                                                        class="cursor-pointer px-4 py-2 hover:bg-gray-100">{{
        merchant.name }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="pos" class="block text-sm font-medium text-gray-700">Buscar
                                                Punto de Venta</label>
                                            <div class="relative">
                                                <input type="text" v-model="posSearch" @input="filterPOS"
                                                    placeholder="Seleccionar Punto de Venta"
                                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" />
                                                <ul v-if="posSearch && filteredPOS.length"
                                                    class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
                                                    <li v-for="pos in filteredPOS" :key="pos.id" @click="selectPOS(pos)"
                                                        class="cursor-pointer px-4 py-2 hover:bg-gray-100">{{ pos.name
                                                        }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="date" class="block text-sm font-medium text-gray-700">Elige una
                                                fecha</label>
                                            <input type="date" id="date" v-model="selectedDate" :min="today"
                                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" />
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" @click="saveAndAssignAnother"
                                                class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar y asignar
                                                otra visita</button>
                                            <button type="submit"
                                                class="bg-green-500 text-white px-4 py-2 rounded-md">Guardar y
                                                cerrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="closeModal"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoaderModal from '@/Components/LoaderModal.vue';
import axios from 'axios';

export default {
    components: { LoaderModal },
    props: {
        showModal: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            selectedMerchant: null,
            selectedPOS: null,
            selectedDate: new Date().toISOString().substr(0, 10),
            today: new Date().toISOString().substr(0, 10),
            merchants: [],
            pos: [],
            filteredMerchants: [],
            filteredPOS: [],
            merchantSearch: '',
            posSearch: '',
            loading: false
        };
    },
    watch: {
        showModal(newVal) {
            if (newVal) {
                this.fetchData();
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        async saveAndAssignAnother() {
            const visitData = {
                merchant_id: this.selectedMerchant,
                pos_id: this.selectedPOS,
                date: this.selectedDate
            };
            try {
                await axios.post('/admin/assignMerchantVisitManual', visitData);
                this.resetForm();
            } catch (error) {
                console.error('Error saving visit:', error);
            }
        },
        async handleSubmit() {
            const visitData = {
                merchant_id: this.selectedMerchant,
                pos_id: this.selectedPOS,
                date: this.selectedDate
            };
            try {
                await axios.post('/admin/assignMerchantVisitManual', visitData);
                //this.$emit('save', visitData);
                this.closeModal();
            } catch (error) {
                console.error('Error saving visit:', error);
            }
        },
        async fetchData() {
            this.loading = true;
            try {
                const [merchantsResponse, posResponse] = await Promise.all([
                    axios.get('/admin/merchants/all'),
                    axios.get('/admin/pointOfSales/all')
                ]);
                this.merchants = merchantsResponse.data;
                this.pos = posResponse.data;
                this.filteredMerchants = this.merchants;
                this.filteredPOS = this.pos;
            } catch (error) {
                console.error('Error fetching data:', error);
            } finally {
                this.loading = false;
            }
        },
        filterMerchants() {
            const search = this.merchantSearch.toLowerCase();
            this.filteredMerchants = this.merchants.filter(merchant => merchant.name.toLowerCase().includes(search));
        },
        filterPOS() {
            const search = this.posSearch.toLowerCase();
            this.filteredPOS = this.pos.filter(pos => pos.name.toLowerCase().includes(search));
        },
        selectMerchant(merchant) {
            this.selectedMerchant = merchant.id;
            this.merchantSearch = merchant.name;
            this.filteredMerchants = [];
        },
        selectPOS(pos) {
            this.selectedPOS = pos.id;
            this.posSearch = pos.name;
            this.filteredPOS = [];
        },
        resetForm() {
            this.selectedMerchant = null;
            this.selectedPOS = null;
            this.selectedDate = new Date().toISOString().substr(0, 10);
            this.merchantSearch = '';
            this.posSearch = '';
        }
    }
};
</script>

<style scoped>
ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
</style>
