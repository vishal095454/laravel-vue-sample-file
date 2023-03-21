<template>
    <div class="absolute left-0 flex flex-col items-center w-full px-36 pr-6 h-[calc(100%-theme(space.28))] top-28">
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-between mb-5">
                <div class="text-left">
                    <h1 class="text-5xl font-bold text-shb-pink">Presentations</h1>
                    <p class="text-xl" style="font: normal normal 300 20px/24px Euclid Circular A;">
                        Create, browse and edit presentations. You currently have 
                        <span class="presentation-count">
                            {{ presentations.length }} active projects.
                        </span>
                    </p>
                </div>
                <div class="flex flex-row items-center justify-center gap-8">
                    <solid-button @click="global.toggleScreen('showNewPresentation')"
                        class="flex flex-row items-center gap-x-2 group">
                        <svg class="w-8" fill="#ffffff" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100"
                            enable-background="new 0 0 100 100" xml:space="preserve" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path
                                        d="M66,47.5H51.5V33.881c0-1.104-0.896-2-2-2s-2,0.896-2,2V47.5H34c-1.104,0-2,0.896-2,2s0.896,2,2,2h13.5v14.381 c0,1.104,0.896,2,2,2s2-0.896,2-2V51.5H66c1.104,0,2-0.896,2-2S67.104,47.5,66,47.5z">
                                    </path>
                                    <path
                                        d="M50.236,16c-18.448,0-33.457,15.008-33.457,33.457c0,18.449,15.009,33.458,33.457,33.458 c18.449,0,33.458-15.009,33.458-33.458C83.694,31.009,68.686,16,50.236,16z M50.236,78.915c-16.242,0-29.457-13.215-29.457-29.458 C20.779,33.215,33.994,20,50.236,20c16.243,0,29.458,13.214,29.458,29.457C79.694,65.7,66.479,78.915,50.236,78.915z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        New presentation
                    </solid-button>
                </div>
            </div>
            <div class="flex flex-row justify-between mb-5 items-center">
                <div class="text-left w-full relative">
                    <input v-model="search" class="w-full pl-12 py-5 border-shb-black-e9e9e9 p-4 rounded focus:border-shb-black-e9e9e9 " type="text"
                        name="search">
                    <div class="search-icon"><svg class="fill-[#C8C8CB] transition-colors group-hover:fill-shb-black w-5"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z" />
                        </svg></div>
                </div>
                <div class="flex flex-row items-center justify-center gap-4">
                    <div class="flex flex-row items-center justify-between ">
                        <div class="flex items-center gap-3 p-6 text-base font-bold">
                            <span :class="isLandlord ? 'text-shb-pink' : 'text-shb-black-7d7e80 '">Landlords</span>
                            <Switch v-model="isLandlord"
                                class="relative inline-flex flex-shrink-0 h-7 transition-colors duration-200 ease-in-out border border-[#2B2D34]  rounded-full cursor-pointer w-11 focus:outline-no">
                                <span aria-hidden="true"
                                    :class="[!isLandlord ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-[26px] w-6 transform rounded-full bg-shb-pink shadow ring-0 transition duration-200 ease-in-out']" />
                            </Switch>
                            <span :class="!isLandlord ? 'text-shb-pink' : 'text-shb-black-7d7e80'">Tenants</span>
                        </div>
                        <div class="flex gap-3">
                            <Popover v-slot="{ open }" class="relative">
                                <PopoverButton :class="open ? '' : 'text-opacity-90'"
                                    class="inline-flex  rounded-md  px-2 py-2  hover:bg-black hover:bg-[#2B2D34]/5">
                                    <svg class="w-6" fill="#000000" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 490 490" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <polygon
                                                    points="85.877,154.014 85.877,428.309 131.706,428.309 131.706,154.014 180.497,221.213 217.584,194.27 108.792,44.46 0,194.27 37.087,221.213 ">
                                                </polygon>
                                                <polygon
                                                    points="404.13,335.988 404.13,61.691 358.301,61.691 358.301,335.99 309.503,268.787 272.416,295.73 381.216,445.54 490,295.715 452.913,268.802 ">
                                                </polygon>
                                            </g>
                                        </g>
                                    </svg>
                                </PopoverButton>

                                <transition enter-active-class="transition duration-200 ease-out"
                                    enter-from-class="translate-y-1 opacity-0" enter-to-class="translate-y-0 opacity-100"
                                    leave-active-class="transition duration-150 ease-in"
                                    leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                                    <PopoverPanel
                                        class="absolute  z-10 mt-1  max-w-sm -translate-x-1/2 transform px-4 sm:px-0 lg:max-w-3xl ">
                                        <div
                                            class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 short-menu">
                                            <div class="relative bg-white ">
                                                <p class="font-bold pointer-events-none">Sort By</p>
                                                <p :class="sortBy == 'client_name' ? 'selected' : ''" @click="()=> sortBy ='client_name'">Client Name (A-Z)</p>
                                                <p :class="sortBy == 'first_name' ? 'selected' : ''" @click="()=> sortBy ='first_name'">Author (A-Z)</p>
                                                <p :class="sortBy == 'presentations.created_at' ? 'selected' : ''" @click="()=> sortBy ='presentations.created_at'">Date added - ascending
                                                </p>
                                                <p :class="sortBy == '-presentations.created_at' ? 'selected' : ''" @click="()=> sortBy ='-presentations.created_at'">Date added - descending
                                                </p>
                                                <p :class="sortBy == 'presentations.updated_at' ? 'selected' : ''" @click="()=> sortBy ='presentations.updated_at'">Activity - ascending</p>
                                                <p :class="sortBy == '-presentations.updated_at' ? 'selected' : ''" @click="()=> sortBy ='-presentations.updated_at'">Activity - descending</p>
                                            </div>
                                        </div>
                                    </PopoverPanel>
                                </transition>
                            </Popover>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-auto max-h-[350px] pb-12 hidden-scroll">
                <table class="presentation-table table-auto text-left border-collapse border-spacing-3 w-full">
                    <tbody>
                        <tr v-for="presentation in presentations">
                            <td class="cursor-pointer" @click="getPresentation(presentation.id)">{{ presentation.client_name }}</td>
                            <td class="">{{ moment(presentation.created_at).format('L') }}</td>
                            <td class="">{{ presentation.first_name }} {{ presentation.last_name }}</td>
                            <td class="">{{ moment(presentation.updated_at).fromNow() }}</td>
                            <td class="">
                                <div class="flex justify-center">
                                    <button class="px-3" @click="deletePresentation(presentation.id)">
                                        <svg class="w-5" fill="#C8C9CC" viewBox="0 0 512 512" id="_x30_1" version="1.1"
                                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M436,40h-81.716c-5.304,0-10.391-2.107-14.142-5.858L311.858,5.858C308.107,2.107,303.02,0,297.716,0h-83.432 c-5.304,0-10.391,2.107-14.142,5.858l-28.284,28.284C168.107,37.893,163.02,40,157.716,40H76c-22.091,0-40,17.909-40,40 s17.909,40,40,40h0v332c0,33.137,26.863,60,60,60h240c33.137,0,60-26.863,60-60V120c22.091,0,40-17.909,40-40S458.091,40,436,40z M216,402c0,16.569-13.431,30-30,30s-30-13.431-30-30V190c0-16.569,13.431-30,30-30s30,13.431,30,30V402z M356,402 c0,16.569-13.431,30-30,30s-30-13.431-30-30V190c0-16.569,13.431-30,30-30s30,13.431,30,30V402z">
                                                </path>
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="px-3" @click="editPresentation(presentation.id)">
                                        <svg class="w-6" fill="#C8C9CC" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M20.548,3.452a1.542,1.542,0,0,1,0,2.182L12.912,13.27,9.639,14.361l1.091-3.273,7.636-7.636A1.542,1.542,0,0,1,20.548,3.452ZM4,21H19a1,1,0,0,0,1-1V12a1,1,0,0,0-2,0v7H5V6h7a1,1,0,0,0,0-2H4A1,1,0,0,0,3,5V20A1,1,0,0,0,4,21Z">
                                                </path>
                                            </g>
                                        </svg>
                                    </button>
                                    <button class="px-3" @click="copyPresentation(presentation.id)">
                                        <svg class="w-6" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
                                            fill="#C8C9CC" transform="matrix(-1, 0, 0, -1, 0, 0)">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g id="Layer_2" data-name="Layer 2">
                                                    <g id="invisible_box" data-name="invisible box">
                                                        <rect width="48" height="48" fill="none"></rect>
                                                    </g>
                                                    <g id="icons_Q2" data-name="icons Q2">
                                                        <path
                                                            d="M42,12H40V40H12v2a2,2,0,0,0,2,2H42a2,2,0,0,0,2-2V14A2,2,0,0,0,42,12ZM34,36a2,2,0,0,0,2-2V6a2,2,0,0,0-2-2H6A2,2,0,0,0,4,6V34a2,2,0,0,0,2,2Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!presentations.length">
                            <td colspan="5" class="text-center">Data not available!!!</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { Switch, Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
    import { useGlobalStore } from "@/stores/useGlobalStore";
    import { onMounted, watch } from "@vue/runtime-core";
    import SolidButton from './../SolidButton.vue';
    import Swal from 'sweetalert2';
    import moment from 'moment';

    const appUrl = import.meta.env.VITE_APP_URL;
    const global = useGlobalStore();
    const isLandlord = ref(true);
    const search = ref('');
    const sortBy = ref('-presentations.created_at');
    const presentations = ref([]);

    // for listing of all presentations
    async function getPresentations() {
        const params = {
            search: search.value,
            sortBy: sortBy.value,
            client_type: (isLandlord.value) ? 'landlord' : 'tenant'
        };

        await axios.get(`${appUrl}/presentations`,{params}).then((response) => {
            presentations.value = response.data;
        }).catch(() => {
            showError();
        });
    }

    // for show presentation details
    async function getPresentation(id, isEditing=false) {
        await axios.get(`${appUrl}/presentations/${id}`).then((response) => {
            global.presentation = response.data;
            const { properties } = response.data;
            global.presentProperty = (properties != null) ? JSON.parse(properties) : [];
            if (isEditing) {
                global.isEditingPresentation = true;
                global.toggleScreen('isPresenting');
            } else {
                global.toggleScreen('showPresentationDetails');
            }
        }).catch(() => {
            showError();
        });
    }

    function editPresentation(id) {
        getPresentation(id, true);
    }

    // for delete presentation
    async function deletePresentation(id) {
        Swal.fire({
            width: 400,
            html: '<p>Are you sure you want to delete this presentation?</p>',
            showCloseButton: true,
            showDenyButton: true,
            reverseButtons:true,
            buttonsStyling: false,
            denyButtonText: 'Cancel',
            confirmButtonText: 'Delete',
            customClass: {
                actions: '!mb-5',
                htmlContainer: 'confirm-title',
                confirmButton: 'primary-btn px-3 w-32 h-12 ml-4 !font-normal',
                denyButton: 'outline-btn px-3 w-32 h-12 !font-normal',
                closeButton: '!font-sans !text-shb-black',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`${appUrl}/presentations/${id}`).then((response) => {
                    const { message } = response.data;
                    getPresentations();

                    Swal.fire({
                        width: 'auto',
                        html: message,
                        position: 'bottom',
                        padding: '4px',
                        timer: 4000,
                        toast: true,
                        timerProgressBar: false,
                        showConfirmButton: true,
                        buttonsStyling: false,
                        confirmButtonText: 'UNDO',
                        customClass: {
                            popup: 'toast-alert',
                            htmlContainer: '!font-light !text-center !pr-[75px]',
                            confirmButton: 'undo-btn',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.post(`${appUrl}/presentations/${id}/restore`).then(() => {
                                getPresentations();
                            });
                        }
                    });
                }).catch(() => {
                    showError();
                });
            }
        });        
    }

    // for create duplicate presentation
    async function copyPresentation(id) {
        Swal.fire({
            width: 400,
            html: '<p>Are you sure you want to copy this presentation?</p>',
            showCloseButton: true,
            showDenyButton: true,
            reverseButtons:true,
            buttonsStyling: false,
            denyButtonText: 'Cancel',
            confirmButtonText: 'Copy',
            customClass: {
                actions: '!mb-5',
                htmlContainer: 'confirm-title',
                confirmButton: 'primary-btn px-3 w-32 h-12 ml-4 !font-normal',
                denyButton: 'outline-btn px-3 w-32 h-12 !font-normal',
                closeButton: '!font-sans !text-shb-black',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(`${appUrl}/presentations/${id}/replicate`).then(() => {
                    getPresentations();

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Presentation successfully duplicate created!',
                        toast: true,
                        position: 'top-right',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    })
                }).catch(() => {
                    showError();
                });
            }
        });
    }

    function showError() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `<p>Something went wrong. Please try again.</p>`,
        })
    }
    
    onMounted(() => {
        global.propertyPage = 0;
        global.presentation = {};
        global.presentProperty = [];
        global.isEditingPresentation = false;
        global.isCreatingPresentation = false;
        getPresentations();
    });

    watch(() => [isLandlord, search, sortBy], () => {
        getPresentations();
    }, { deep: true })

</script>