<script setup lang="ts">
import AuthenticatedLayout from "../../js/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";




</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

            <div class="container min-h-screen flex justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Row 1 -->
            <div class="bg-gray-200 p-4 md:col-span-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quod at nam sit repellendus odit quibusdam porro nihil voluptate. Delectus, molestiae suscipit. Aliquam quibusdam aspernatur natus eveniet laboriosam repudiandae dolorum?
            Odio saepe perferendis necessitatibus nihil voluptates, sapiente sequi minima quasi obcaecati eligendi quisquam praesentium quod sit maiores, assumenda nobis commodi quas sint? Vero ex cumque dolor incidunt odit culpa nulla.
            Voluptatem laboriosam nihil perferendis optio, esse soluta praesentium molestias placeat, sunt assumenda quae maxime tenetur quibusdam? Asperiores architecto quibusdam reiciendis, veritatis vel, quo quas esse porro doloremque molestias excepturi! Tempore?</div>
            
            <!-- Row 2 -->
            <div class="bg-gray-300 p-4">Row 2, Column 1</div>
            <div class="bg-gray-300 p-4">Row 2, Column 2</div>
        </div>
    </div>
</AuthenticatedLayout>
        </template>
  







