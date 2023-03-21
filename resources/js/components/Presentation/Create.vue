<template>
    <div class="absolute left-0 flex flex-col items-center w-full px-36 pr-6 h-[calc(100%-theme(space.28))] top-28">
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-between">
                <div class="text-left">
                    <h1 class="text-5xl font-bold text-shb-pink">New Presentation</h1>
                    <p class="text-xl">Add your client details.</p>
                </div>                
            </div>
            <form>
                <div class="grid grid-cols-12 mt-8">
                    <div class="col-span-9 h-[450px] overflow-y-auto p-1 hidden-scroll">
                        <div class="col-span-12 pt-4 text-left gap-x-8">
                            <div class="flex flex-row justify-between">
                                <label for="name" class="block col-span-2 text-sm font-semibold">Client Name</label>
                                <div v-if="errors && errors.client_name" class="text-base text-[#FF5964]">{{ errors.client_name[0] }}</div>
                            </div>
                            <div class="col-span-4 mt-4">
                                <input class="w-full border-shb-black-e9e9e9 p-4 rounded" :class="errors && errors.client_name ? 'border-[#FF5964]': ''" type="text" name="client_name" v-model="fields.client_name" placeholder="Enter your client name here">
                            </div>
                        </div>
                        <div class="col-span-12 pt-4 text-left gap-x-8">
                            <div class="flex flex-row justify-between">
                                <label for="name" class="block col-span-2 text-sm font-semibold">Location</label>
                                <div v-if="errors && errors.location" class="text-base text-[#FF5964]">{{ errors.location[0] }}</div>
                            </div>
                            <div class="col-span-4 mt-4">
                                <input class="w-full border-shb-black-e9e9e9 p-4 rounded" :class="errors && errors.location ? 'border-[#FF5964]': ''" type="text" name="location" v-model="fields.location" placeholder="Enter your client location here">
                            </div>
                        </div>
                        <div class="col-span-12 pt-4 text-left gap-x-8">
                            <div class="flex flex-row justify-between">
                                <label for="name" class="block col-span-2 text-sm font-semibold">Client Type</label>
                                <div v-if="errors && errors.client_type" class="text-base text-[#FF5964]">{{ errors.client_type[0] }}</div>
                            </div>
                            <div class="mt-4 flex flex-row items-center">
                                <div class="pl-2">
                                    <input  type="radio" name="client_type" v-model="fields.client_type"  value="landlord" class="h-6 w-6" :class="errors && errors.client_type ? 'border-[#FF5964]': ''">
                                    <span class="ml-3 text-sm">Landlord</span>
                                </div>
                                <div class="pl-2 ml-10">
                                    <input  type="radio" name="client_type" v-model="fields.client_type"  value="tenant" class="h-6 w-6" :class="errors && errors.client_type ? 'border-[#FF5964]': ''">
                                    <span class="ml-3 text-sm">Tenant</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 pt-4 text-left gap-x-8">
                            <label for="name" class="block col-span-2 text-sm font-semibold">Requirements</label>
                            <div class="col-span-4 mt-4">
                                <textarea class="w-full border-shb-black-e9e9e9 p-4 rounded"  name="requirements" v-model="fields.requirements" placeholder="Add a summary of your client's brief here" />
                            </div>
                        </div>
                        <div class="col-span-12 pt-4 text-left gap-x-8">
                            <div class="flex flex-row justify-between">
                                <label for="name" class="block col-span-2 text-sm font-semibold">Size</label>
                                <div v-if="errors && errors.size" class="text-base text-[#FF5964]">{{ errors.size[0] }}</div>
                            </div>
                            <div class="col-span-4 mt-4">
                                <input class="w-full border-shb-black-e9e9e9 p-4 rounded" :class="errors && errors.size ? 'border-[#FF5964]': ''" type="text" name="size" v-model="fields.size" placeholder="Size of the space or number of desks">
                            </div>
                        </div>
                        <div class="col-span-12 pt-4 text-left gap-x-8">
                            <div class="flex flex-row justify-between">
                                <label for="name" class="block col-span-2 text-sm font-semibold">Budget</label>
                                <div v-if="errors && errors.budget" class="text-base text-[#FF5964]">{{ errors.budget[0] }}</div>
                            </div>
                            <div class="col-span-4 mt-4">
                                <input class="w-full border-shb-black-e9e9e9 p-4 rounded" :class="errors && errors.budget ? 'border-[#FF5964]': ''" type="text" name="budget" v-model="fields.budget" placeholder="Enter your client budget here">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <div class="col-span-12 pt-4 h-full">
                            <div class="flex flex-col items-end justify-end gap-5 h-full pb-5">
                                <solid-button @click="saveWithProperty" class="w-3/4 pr-4 pl-4" >Save + Add Properties</solid-button>
                                <button @click="saveAndReturn" class="dark-btn w-3/4"> <span class="mr-1 text-xl">&lt;</span> Save + Return</button>
                                <outline-button type="button" @click="global.toggleScreen('showPresentation')" class="w-3/4"> Cancel
                                </outline-button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import { reactive, ref } from 'vue'
    import { useGlobalStore } from "@/stores/useGlobalStore";
    import SolidButton from './../SolidButton.vue'
    import OutlineButton from './../OutlineButton.vue'
    import Swal from 'sweetalert2'

    const global = useGlobalStore()

    let fields = reactive({
        client_name: null,
        client_type: null,
        location: null,
        size: null,
        budget: null,
        requirements: null
    })

    let errors = ref({})

    // form submit for create presentation
    async function submitForm(isReturn=false) {
        errors.value = {}
        await axios.post(`presentations`, fields).then(response => {
            console.log(response.data);
            
            if (isReturn) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Presentation successfully created!',
                    toast: true,
                    position: 'top-right',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                })
                global.toggleScreen('showPresentation');
            } else {
                global.presentation = response.data;
                global.isCreatingPresentation = true;
                global.toggleScreen('isPresenting');
            }
        }).catch(error => {
            console.log(error);
            if (error.response?.status === 422) {
                errors.value = error.response.data.errors || ref({});
            }
        });
    }

    function saveAndReturn(e) {
        e.preventDefault();
        submitForm(true);
    }

    function saveWithProperty(e) {
        e.preventDefault();
        submitForm();
    }
</script>