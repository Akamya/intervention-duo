<script setup>
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
// const props = defineProps(["interventions"]);
import NavLink from "@/Components/NavLink.vue";

import { useForm, usePage } from "@inertiajs/vue3";

const props = defineProps(["interventions", "id"]);
const form = useForm(props);
function nomuser(user_id) {}
</script>

<template>
    <AppLayout title="Interventions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des Interventions
            </h2>
        </template>

        <NavLink
            class="mt-4 text-white"
            :href="route('interventions.create', id)"
        >
            <button class="py-4 px-6 rounded-lg ml-4 bg-blue-400">Créer</button>
        </NavLink>

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
                        <tr
                            v-for="intervention in interventions"
                            :key="intervention.id"
                            class="hover:bg-gray-50 even:bg-gray-50"
                            @click="
                                () =>
                                    $inertia.get(
                                        route(
                                            'interventions.show',
                                            intervention.id
                                        )
                                    )
                            "
                        >
                            <td class="px-4 py-2 text-gray-800">
                                {{ intervention.ticket.client.nom }}
                            </td>
                            <td class="px-4 py-2 text-gray-800">
                                {{ intervention.user.nom }}
                            </td>
                            <td class="px-4 py-2 text-gray-800">
                                {{ intervention.title }}
                            </td>
                            <td class="px-4 py-2 text-gray-800">
                                {{ intervention.comment }}
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
