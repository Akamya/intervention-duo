<script setup>
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
// const props = defineProps(["interventions"]);
import NavLink from "@/Components/NavLink.vue";

import { useForm, usePage } from "@inertiajs/vue3";

const props = defineProps(["interventions", "images"]);
const form = useForm(props);
</script>

<template>
    <AppLayout title="Intervention">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Intervention
            </h2>
        </template>

        <div class="p-6 bg-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr
                            class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal"
                        >
                            <th class="py-3 px-6 text-left">Clients</th>
                            <th class="py-3 px-6 text-left">Technicien</th>
                            <th class="py-3 px-6 text-left">Titre</th>
                            <th class="py-3 px-6 text-left">Commentaire</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr class="hover:bg-gray-50 even:bg-gray-50">
                            <td class="px-4 py-2 text-gray-800">
                                {{ interventions.user_id }}
                            </td>
                            <td class="px-4 py-2 text-gray-800">
                                {{ interventions.ticket_id }}
                            </td>
                            <td class="px-4 py-2 text-gray-800">
                                {{ interventions.title }}
                            </td>
                            <td class="px-4 py-2 text-gray-800">
                                {{ interventions.comment }}
                            </td>
                        </tr>
                        <tr>
                            <td
                                v-for="image in images"
                                :key="image.id"
                                class="px-4 py-2 text-gray-800"
                            >
                                <img
                                    :src="`/storage/${image.img_path}`"
                                    :alt="`${image.id}`"
                                />
                            </td>
                            <!-- </form> -->
                        </tr>
                        <!-- Ajouter plus de lignes ici -->
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
