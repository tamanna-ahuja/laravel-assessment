<script setup lang="ts">
import Hero from "@/Components/Dashboard/Hero.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { defineProps } from "vue";

defineProps({
    jobs: Array,
});
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <Hero />
        <div class="bg-white">
            <div class="container py-5">
                <div class="grid grid-cols-2 gap-4">
                    <div
                        v-for="job in jobs"
                        :key="job.id"
                        class="p-4 border rounded shadow"
                    >
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <img
                                    :src="job.company_logo"
                                    alt="Logo"
                                    class="w-12 h-12 rounded-full"
                                    v-if="job.company_logo"
                                />
                                <div>
                                    <h2 class="font-bold text-lg">
                                        {{ job.title }}
                                    </h2>
                                    <p class="text-sm text-gray-500">
                                        {{ job.company_name }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-sm float-right">
                                <span
                                    v-for="extra in job.extra"
                                    :key="extra"
                                    class="inline-block bg-gray-200 px-2 py-1 text-xs rounded-full mr-2"
                                >
                                    {{ extra }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-2 flex space-x-3 text-sm text-gray-500">
                            <span
                                ><i class="fas fa-suitcase"></i>
                                {{ job.experience }}</span
                            >
                            <span
                                ><i class="fa-solid fa-indian-rupee-sign"></i>
                                {{ job.salary }}</span
                            >
                            <span
                                ><i class="fas fa-map-marker-alt"></i>
                                {{ job.location }}</span
                            >
                        </div>
                        <div class="mt-3 text-gray-600">
                            {{ job.description }}
                        </div>

                        <div class="mt-2">
                            <div class="mt-2 flex items-center flex-wrap gap-1">
                                <span
                                    v-for="(skill, index) in job.skills"
                                    :key="skill"
                                    class="text-sm text-gray-700 flex items-center"
                                >
                                    {{ skill }}
                                    <span
                                        v-if="index !== job.skills.length - 1"
                                        class="text-gray-400 mx-1 flex items-center"
                                        style="font-size: 30px; line-height: 1"
                                    >
                                        •
                                    </span>
                                </span>
                            </div>

                            <div class="text-sm text-gray-400 float-right">
                                {{ job.posted_at }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
