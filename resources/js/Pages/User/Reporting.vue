<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage } from "@inertiajs/vue3";

// Récupération des données de page transmises par le contrôleur Laravel via Inertia
const { props } = usePage();
console.log(props);
const clients = props.clients; // clients avec tickets et interventions associés
</script>

<template>
    <AppLayout title="Tickets et Interventions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des Tickets et Interventions du Client
            </h2>
        </template>

        <div class="p-6 bg-gray-100">
            <div v-for="client in clients" :key="client.id" class="mb-8">
                <!-- Client -->
                <div class="bg-white shadow rounded-lg p-4 mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Client : {{ client.nom }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        Email : {{ client.email }}
                    </p>
                </div>

                <!-- Tickets du client -->
                <div
                    v-for="ticket in client.tickets"
                    :key="ticket.id"
                    class="mb-6"
                >
                    <div
                        class="bg-blue-50 border border-blue-200 shadow rounded-lg p-4"
                    >
                        <h4 class="text-md font-semibold text-blue-800">
                            Ticket : {{ ticket.title }}
                        </h4>
                        <p class="text-sm text-gray-700">
                            Description : {{ ticket.description }}
                        </p>
                        <p class="text-sm text-gray-600">
                            Statut :
                            <span class="font-medium">{{ ticket.statut }}</span>
                        </p>
                    </div>

                    <!-- Interventions associées -->
                    <div v-if="ticket.interventions.length" class="ml-6 mt-4">
                        <h5 class="text-sm font-semibold text-gray-700 mb-2">
                            Interventions :
                        </h5>
                        <ul class="space-y-2">
                            <li
                                v-for="intervention in ticket.interventions"
                                :key="intervention.id"
                                class="bg-white border border-gray-200 shadow rounded-lg p-3"
                            >
                                <p class="text-sm">
                                    <span class="font-medium text-gray-800"
                                        >Titre :</span
                                    >
                                    {{ intervention.title }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium text-gray-800"
                                        >Commentaire :</span
                                    >
                                    {{ intervention.comment }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium text-gray-800"
                                        >Technicien :</span
                                    >
                                    {{ intervention.user.nom }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Date : {{ intervention.created_at }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
