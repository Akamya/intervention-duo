<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
defineProps(["users"]);
</script>

<template>
    <AppLayout title="Technicien">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des Techniciens
            </h2>
        </template>
        <div class="overflow-x-auto p-5">
            <table
                class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden"
            >
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700">
                        <th class="px-4 py-2 font-medium">Nom</th>
                        <th class="px-4 py-2 font-medium">Prénom</th>
                        <th class="px-4 py-2 font-medium">Email</th>
                        <th class="px-4 py-2 font-medium">Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="hover:bg-gray-50 even:bg-gray-50"
                    >
                        <td class="px-4 py-2 text-gray-800">
                            {{ user.nom }}
                        </td>
                        <td class="px-4 py-2 text-gray-800">
                            {{ user.prenom }}
                        </td>
                        <td class="px-4 py-2 text-gray-800">
                            {{ user.email }}
                        </td>
                        <td class="px-4 py-2 text-gray-800">
                            <span
                                v-if="user.is_admin"
                                class="text-green-600 font-bold"
                                >Oui</span
                            >
                            <span v-else class="text-red-600 font-bold"
                                >Non</span
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
