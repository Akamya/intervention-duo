<script setup>
import { defineProps } from "@vue/runtime-core";

defineProps(["clients"]);
</script>

<template>
    <!-- Contenu principal -->
    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
            Liste des clients
        </h1>

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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
