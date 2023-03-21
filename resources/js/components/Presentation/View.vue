<template>
    <div class="absolute left-0 flex flex-col items-center w-full px-36 pr-6 h-[calc(100%-theme(space.28))] top-28">
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-between w-4/5">
                <div class="text-left">
                    <h1 class="text-[6rem] font-semibold text-shb-pink leading-tight capitalize">{{presentation?.client_name}}</h1>
                </div>                
            </div>
                <div class="grid grid-cols-8 mt-8 text-left font-semibold">  
                    <div class="pt-4">                            
                        <label class="text-shb-pink text-base">Size</label>
                        <div class="text-xl text-shb-black">
                            {{presentation?.size}}
                        </div>
                    </div>
                    <div class="pt-4">
                        <label class="text-shb-pink text-base">Budget</label>                        
                        <div class="text-xl text-shb-black">
                            {{presentation?.budget}}
                        </div>
                    </div>  
                    <div class="pt-4">
                        <label class="text-shb-pink text-base">Location</label>                        
                        <div class="text-xl text-shb-black w-[450px]">
                            {{presentation?.location}}
                        </div>
                    </div>
                    <div class="col-span-12 mt-10">
                            <label class="text-shb-pink text-base">Requirements</label>                        
                            <div class="text-base font-normal text-shb-black w-1/2">
                                {{presentation?.requirements}}
                            </div>
                    </div>              
                    <div class="col-span-12">
                        <div class="flex items-end justify-end gap-5 h-full pb-5 mt-8">
                            <outline-button type="button" @click="global.toggleScreen('showPresentation')" class="w-60"> Back
                            </outline-button>
                            <solid-button @click="global.toggleScreen('isPresenting')" class="w-60 pr-4 pl-4 flex items-center justify-center" >
                                <svg class="w-[26px] mr-2" fill="#ffffff"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 297 297" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M148.5,0C66.486,0,0,66.486,0,148.5S66.486,297,148.5,297S297,230.514,297,148.5S230.514,0,148.5,0z M202.79,161.734 l-78.501,45.322c-2.421,1.398-5.326,2.138-8.083,2.138c-8.752,0-16.039-7.12-16.039-15.872v-90.645 c0-8.752,7.287-15.872,16.039-15.872c2.758,0,5.579,0.739,8.001,2.138l78.542,45.322c4.966,2.867,7.951,8.001,7.951,13.734 S207.756,158.867,202.79,161.734z"></path> </g>
                                </svg>
                                 Start Presentation
                            </solid-button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { useGlobalStore } from "@/stores/useGlobalStore";
    import SolidButton from './../SolidButton.vue';
    import OutlineButton from './../OutlineButton.vue';

    const global = useGlobalStore();
    const presentation = reactive(global.presentation);
    
</script>