<script setup>
import { defineProps } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps(["client", "tickets"]);
</script>

<template>
    <AppLayout title="Client">
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-6">
                    <h1 class="text-2xl font-bold mb-4 text-gray-800">
                        Informations du client
                    </h1>

                    <div class="mt-6 flex justify-end">
                        <button
                            @click="
                                () =>
                                    $inertia.get(
                                        route('tickets.create', client.id)
                                    )
                            "
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
                        >
                            Création d'un ticket
                        </button>
                    </div>

                    <!-- Affichage des infos client -->
                    <div class="mb-6">
                        <p><strong>Nom :</strong> {{ client.nom }}</p>
                        <p><strong>Prénom :</strong> {{ client.prenom }}</p>
                        <p><strong>Email :</strong> {{ client.email }}</p>
                        <p>
                            <strong>Téléphone :</strong> {{ client.telephone }}
                        </p>
                    </div>

                    <!-- Liste des tickets -->
                    <h2 class="text-xl font-bold mb-4 text-gray-700">
                        Tickets
                    </h2>
                    <ul>
                        <li
                            @click="
                                () =>
                                    $inertia.get(
                                        route('interventions.index', ticket.id)
                                    )
                            "
                            v-for="ticket in tickets"
                            :key="ticket.id"
                            class="mb-4 p-4 border rounded shadow-sm cursor-pointer"
                        >
                            <p><strong>Titre :</strong> {{ ticket.title }}</p>
                            <p>
                                <strong>Catégorie :</strong>
                                {{ ticket.categorie }}
                            </p>
                            <p>
                                <strong>Commentaire :</strong>
                                {{ ticket.commentaire }}
                            </p>

                            <p>
                                <strong>Date de création :</strong>
                                {{
                                    new Date(
                                        ticket.created_at
                                    ).toLocaleDateString("fr-FR")
                                }}
                                <!-- Merci chatgpt -->
                            </p>

                            <p>
                                <strong>Statut :</strong>
                                {{ ticket.statut }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
