<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage, useForm } from "@inertiajs/vue3";

// Récupération des données de page transmises par le contrôleur Laravel via Inertia

// const propsTickets = defineProps(["tickets"]);
// const { propsTickets } = usePage();

// console.log(propsTickets);

const { props } = usePage();
// console.log(props);
const clients = props.clients; // clients avec tickets et interventions associés
const tickets = props.tickets;

const ticketsAnnee = props.ticketsAnnee;
const ticketsMois = props.ticketsMois;
const ticketsJour = props.ticketsJour;
const ticketsgraphique = props.ticketsgraphique;

// console.log(ticketsAnnee);
console.log(ticketsAnnee);
// console.log(ticketsgraphique);

const typeCouleur = [
    {
        chiffreParTicket: "1",
        couleur:
            "border-blue-600 border-b-4 w-2 mb-2.5 rotate-90 justify-self-center",
    },
    {
        chiffreParTicket: "2",
        couleur:
            "border-black border-b-4 w-4  relative  bottom-2 rotate-90 justify-self-center",
    },
    {
        chiffreParTicket: "3",
        couleur:
            "border-yellow-500 border-b-4 w-5  relative  bottom-2.5 rotate-90 justify-self-center",
    },
    {
        chiffreParTicket: "4",
        couleur:
            "border-red-400 border-b-4 w-6  relative  bottom-3 rotate-90 justify-self-center",
    },

    {
        chiffreParTicket: "6",
        couleur:
            "border-purple-700 border-b-4 w-8  relative  bottom-4 rotate-90 justify-self-center",
    },

    {
        chiffreParTicket: "8",
        couleur:
            "border-green-700 border-b-4 bottom-6 w-10  relative bottom-5 rotate-90 justify-self-center",
    },
    {
        chiffreParTicket: "9",
        couleur:
            "border-orange-500 border-b-4 bottom-6 w-12  relative  bottom-6 rotate-90 justify-self-center",
    },

    {
        chiffreParTicket: "10",
        couleur:
            "border-cyan-400 border-b-4 w-12 relative  bottom-6 rotate-90 justify-self-center",
    },
];

for (let index = 0; index < ticketsAnnee.length; index++) {
    const found = typeCouleur.find(
        (element) => element.chiffreParTicket >= ticketsAnnee[index].count
    );
    ticketsAnnee[index].couleur = found.couleur;
}
console.log(ticketsAnnee);
</script>

<template>
    <AppLayout title="Tickets et Interventions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des Tickets et Interventions des Clients
            </h2>
        </template>

        <div class="border-4 mx-8">
            <h1 class="font-extrabold text-center">Nombre de tickets</h1>

            <div class="flex justify-evenly flex-wrap gap-2 align-middle py-2">
                <div
                    class="content-end pt-14"
                    v-for="ticketAnnee in ticketsAnnee"
                >
                    <p :class="`${ticketAnnee.couleur}`"></p>
                    <p class="justify-self-center">
                        Ticket(s): {{ ticketAnnee.count }}
                    </p>
                    <p class="justify-self-center">
                        Date : {{ ticketAnnee.created_at }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-100 m-2 border-b-red-600">
            <div v-for="client in clients" :key="client.id" class="mb-8">
                <!-- Client -->
                <div class="bg-white shadow rounded-lg p-4 mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Client : {{ client.nom }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        Email : {{ client.email }}
                    </p>
                    <p class="text-sm text-gray-600 font-extrabold">
                        Nombre de ticket(s) : {{ client.tickets.length }}
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
                        <p class="text-sm text-gray-600 font-extrabold">
                            Nombre d'intervention(s) :
                            {{ ticket.interventions.length }}
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
