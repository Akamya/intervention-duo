<script setup>
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
// const props = defineProps(["interventions"]);
import NavLink from "@/Components/NavLink.vue";

import { useForm, usePage } from "@inertiajs/vue3";

const props = defineProps(["interventions", "ticket", "statuts"]);
const form = useForm({
    statut: props.ticket.statut,
});
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
            :href="route('interventions.create', ticket)"
        >
            <button class="py-4 px-6 rounded-lg ml-4 bg-blue-400">Créer</button>
        </NavLink>
        <form
            @submit.prevent="form.put(route('interventions.statuts', ticket))"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            <div>
                <label
                    for="statut"
                    class="block text-sm font-medium text-gray-700"
                >
                    Statut
                </label>
                <select
                    id="statut"
                    v-model="form.statut"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="" disabled>Statut</option>
                    <option
                        v-for="statut in statuts"
                        :key="statut"
                        :value="statut"
                    >
                        {{ statut }}
                    </option>
                </select>
                <div
                    v-if="form.errors.statut"
                    class="text-sm text-red-500 mt-1"
                >
                    {{ form.errors.statut }}
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
                >
                    Enregistrer les modifications
                </button>
            </div>
        </form>
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
                            <th class="py-3 px-6 text-left">Détails</th>

                            <th class="py-3 px-6 text-left">Modifier</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr
                            v-for="intervention in interventions"
                            :key="intervention.id"
                            class="hover:bg-gray-50 even:bg-gray-50"
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
                            <td class="px-4 py-2 text-gray-800">
                                <button
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
                                    Voir
                                </button>
                            </td>

                            <td class="px-4 py-2 text-gray-800">
                                <button
                                    @click="
                                        () =>
                                            $inertia.get(
                                                route(
                                                    'interventions.edit',
                                                    intervention.id
                                                )
                                            )
                                    "
                                >
                                    Modifier
                                </button>
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
