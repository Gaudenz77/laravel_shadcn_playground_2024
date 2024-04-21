<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MyFooter from '@/Components/MyFooter.vue';
import { defineProps, onMounted, ref, computed } from 'vue';
import TwitterTimeline from '../Components/TwitterTimeline.vue'; // Import TwitterTimeline component
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

onMounted(() => {
    // Add Twitter script
    const twitterScript = document.createElement('script');
    twitterScript.async = true;
    twitterScript.src = 'https://platform.twitter.com/widgets.js';
    twitterScript.charset = 'utf-8';
    document.body.appendChild(twitterScript);

    // Add ElfSight script
    const elfSightScript = document.createElement('script');
    elfSightScript.async = true;
    elfSightScript.src = 'https://static.elfsight.com/platform/platform.js';
    elfSightScript.dataset.useServiceCore = '';
    document.body.appendChild(elfSightScript);

    // Add ElfSight script
    const tagembedScript = document.createElement('script');
    tagembedScript.async = true;
    tagembedScript.src = '//widget.tagembed.com/embed.min.js';
    tagembedScript.dataset.useServiceCore = '';
    document.body.appendChild(tagembedScript);
});


const showSmiley = ref(false);

const toggleSmiley = () => {
    showSmiley.value = !showSmiley.value;
};


const gridClasses = computed(() => {
      if (!showSmiley.value) {
        return 'grid grid-cols-3 gap-4';
      }
      return 'grid grid-cols-1 gap-4';
    });


</script>


<template>
    <Head title="Welcome" />
    <GuestLayout>

        <!-- Remove max-w-7xl and mx-auto classes from the parent div -->
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <!-- <Link
                v-if="$page.props.auth.user"
                :href="route('testpage')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >testpage</Link
            > -->

           <!--  <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register</Link>
            </template> -->
        </div>


        <div class="hero">
            <div class="overlay">
                <div class="justify-center align-middle text-9xl text-white">
                    <div class="heroText">
                        <strong>Hello Yalls</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mx-auto mt-8 flex flex-col md:flex-row justify-between mb-12">
    <!-- Column 1 -->
        <div class="w-full md:w-1/3  p-4 text-center">
            Column 1
            <div  class="twitterOwn mt-20 flex justify-center overflow-auto">
                <!-- <TwitterTimeline /> -->
               <!--  <a class="twitter-timeline" data-width="400" data-height="600" data-theme="dark" href="https://twitter.com/Krakatoom1?ref_src=twsrc%5Etfw">Tweets by Krakatoom1</a> -->
            
            
                <!-- <a class="twitter-timeline"
                    href="https://twitter.com/Krakatoom1?ref_src=twsrc%5Etf" data-width="400" data-height="600" data-theme="dark">
                    Tweets by @me
                </a> -->

                <!-- <div class="tagembed-widget dark:text-emerald-900 text-indigo-800" style="width:100%;height:100%"  data-theme="dark" data-widget-id="146588" view-url="https://widget.tagembed.com/146588"></div> -->
                <iframe src="https://widget.tagembed.com/146588?view" style=" width:100%;height:500px;overflow: auto;" frameborder="0" allowtransparency="true"></iframe>
            
            </div>
        </div>
        
        <!-- Column 2 -->
        <div class="w-full md:w-1/3 p-4 text-center mt-4 md:mt-0">
            Column 2
            <div class="elfsight-app-5fcd6d44-0677-4230-9a23-ef78a60b86fd" data-elfsight-app-lazy></div>
            <!-- <a class="twitter-timeline" href="https://twitter.com/tanamongeau?ref_src=twsrc%5Etfw">Tweets by tanamongeau</a> -->
        </div>
        
        <!-- Column 3 -->
        <div class="w-full md:w-1/3 p-4 text-center mt-4 md:mt-0 flex justify-center overflow-auto">
            <!-- <blockquote class="twitter-tweet ">
                <p lang="en" dir="ltr">Welcome Yalls on this Testpage?</p>
                &mdash; Krakatoom (@Krakatoom1) 
                <a class="" href="https://twitter.com/Krakatoom1/status/1779444260766360016?ref_src=twsrc%5Etfw">April 14, 2024</a>
            </blockquote> -->
            <TwitterTimeline />
        </div>
    </div>


    <div class="container mx-auto">
        <div  class="flex flex-col md:flex-row justify-between">
            <!-- Column 1 -->
            <div class="w-full md:w-auto lg:w-full bg-gray-200 p-4 text-center">
                <button @click="toggleSmiley" class="bg-blue-500 text-white px-4 py-2 rounded-full">
                    <i class="fas fa-smile"></i> Show Smiley
                </button>
                <div :class="{ 'hidden': !showSmiley }" class="text-4xl mt-4"><i class="fas fa-laugh-wink text-[#ff0012] fa-3x fa-flip"></i></div>
            </div>

            <!-- Column 2 -->
            <div class="w-full md:w-auto lg:w-full bg-gray-300 p-4 text-center mt-4 md:mt-0">
                Column 2
            </div>

            <!-- Column 3 -->
            <div class="w-full md:w-auto lg:w-full bg-gray-400 p-4 text-center mt-4 md:mt-0">
                Column 3
            </div>
        </div>
    </div>


    </GuestLayout>
</template>


<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.hero {
    background-image: url("../../../public/assetsown/img/iceberg_survalizer_notext.png");
    height: 70vh;
    background-repeat: no-repeat;
    background-size: cover;
}

.overlay {
    background-color: rgba(255, 0, 255, 0.5);
    /* Adjust opacity value here */
    position: relative;
    z-index: 5;
    width:100%;
    height:100%;
    text-align:center;
}

.heroText{
    position: relative;
  top: 15rem;
  bottom: 5rem;
}
</style>    
