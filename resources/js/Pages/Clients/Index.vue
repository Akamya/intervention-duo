<script setup>
import { defineProps } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps(["clients"]);
</script>

<template>
    <AppLayout title="Client">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des Clients
            </h2>
        </template>
        <!-- Contenu principal -->
        <div class="container mx-auto mt-10 px-4">
            <div class="mt-6 flex justify-end">
                <button
                    @click="() => $inertia.get(route('clients.create'))"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
                >
                    Ajouter un nouveau client
                </button>
            </div>

            <!-- Tableau des clients -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-sm font-semibold text-gray-600"
                            >
                                Nom
                            </th>
                            <th
                                class="px-6 py-3 text-left text-sm font-semibold text-gray-600"
                            >
                                Prénom
                            </th>
                            <th
                                class="px-6 py-3 text-left text-sm font-semibold text-gray-600"
                            >
                                Email
                            </th>
                            <th
                                class="px-6 py-3 text-left text-sm font-semibold text-gray-600"
                            >
                                Téléphone
                            </th>
                            <th
                                class="px-6 py-3 text-left text-sm font-semibold text-gray-600"
                            >
                                Détails
                            </th>
                            <th
                                class="px-6 py-3 text-left text-sm font-semibold text-gray-600"
                            >
                                Modifier
                            </th>
                            <th
                                class="px-6 py-3 text-left text-sm font-semibold text-gray-600"
                            >
                                Supprimer
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="client in clients"
                            :key="client.id"
                            class="border-b hover:bg-gray-50"
                        >
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ client.nom }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ client.prenom }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ client.email }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ client.telephone }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm text-gray-800 font-bold"
                            >
                                <button
                                    @click="
                                        () =>
                                            $inertia.get(
                                                route('clients.show', client.id)
                                            )
                                    "
                                >
                                    Voir
                                </button>
                            </td>
                            <td class="px-6 py-4 text-sm text-blue-500">
                                <button
                                    @click="
                                        () =>
                                            $inertia.get(
                                                route('clients.edit', client.id)
                                            )
                                    "
                                >
                                    Modifier
                                </button>
                            </td>
                            <td class="px-6 py-4 text-sm text-red-500">
                                <button
                                    @click="
                                        () =>
                                            $inertia.delete(
                                                route(
                                                    'clients.destroy',
                                                    client.id
                                                )
                                            )
                                    "
                                >
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
