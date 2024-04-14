<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MyFooter from '@/Components/MyFooter.vue';
import { defineProps, onMounted } from 'vue';
import TwitterTimeline from '../Components/TwitterTimeline.vue'; // Import TwitterTimeline component
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

onMounted(() => {
    const script = document.createElement('script');
    script.async = true;
    script.src = 'https://platform.twitter.com/widgets.js';
    script.charset = 'utf-8';
    document.body.appendChild(script);
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
    <div class="container mx-auto mt-8 flex justify-between mb-12">
        <div class="w-1/3 bg-gray-200 p-4 text-center">
                <!-- <div class="twitterOwn mt-20">
                  
                    <a class="twitter-timeline" href="https://twitter.com/Krakatoom1?ref_src=twsrc%5Etfw">Tweets by Krakatoom1</a>
                    </div>
                </div> -->
                Column 1
                <div class="twitterOwn mt-20">
                    
                    <TwitterTimeline />
                </div>
                </div>
        <div class="w-1/3 bg-gray-300 p-4 text-center">
            Column 2
         <!--    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a> -->
        </div>
        <div class="w-1/3 bg-gray-400 p-4 text-center">
        <blockquote class="twitter-tweet"><p lang="en" dir="ltr">Welcome Yalls on this Testpage?</p>&mdash; Krakatoom (@Krakatoom1) <a href="https://twitter.com/Krakatoom1/status/1779444260766360016?ref_src=twsrc%5Etfw">April 14, 2024</a></blockquote></div>
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
