<script setup>
import { defineProps } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";

//MODAL
import DialogModal from "@/Components/DialogModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ActionModal from "@/Components/ActionModal.vue";

const props = defineProps(["clients"]);

let selected_user_id = 0;
let selected_user_nom = "";
let selected_user_prenom = "";
const form = useForm(props);

// Texte saisi dans l'input
let search = ref("");

// Résultats de la recherche
let clientRecherche = ref(props.clients); // Initialise avec tous les clients

// Fonction de recherche
function function_rechercher() {
    const searchValue = search.value.toLowerCase();

    // Filtrer la liste des clients selon le texte saisi
    clientRecherche.value = props.clients.filter((client) => {
        return (
            client.nom.toLowerCase().includes(searchValue) ||
            client.prenom.toLowerCase().includes(searchValue)
        );
    });
}

// DELETE AVEC MODAL
const confirmingUserDeletion = ref(false);

const confirmUserDeletion = (id, prenom, nom) => {
    selected_user_id = id;
    selected_user_prenom = prenom;
    selected_user_nom = nom;
    confirmingUserDeletion.value = true;
};

function deleteTechnicien() {
    form.delete(route("clients.destroy", selected_user_id), {
        onSuccess: () => closeModal(),
    });
}
const closeModal = () => {
    confirmingUserDeletion.value = false;
};
</script>

<template>
    <AppLayout title="Liste des clients">
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

            <label class="mx-4 font-bold">Recherche : </label>
            <input
                :clients
                class="mr-5 w-64"
                type="search"
                name="search"
                id="search"
                v-model="search"
                placeholder="Rechercher un client"
                @input="function_rechercher"
            />

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
                            v-for="client in clientRecherche"
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
                                <ActionModal>
                                    <template #content>
                                        <div class="">
                                            <DangerButton
                                                @click="
                                                    confirmUserDeletion(
                                                        client.id,
                                                        client.prenom,
                                                        client.nom
                                                    )
                                                "
                                            >
                                                Supprimer
                                            </DangerButton>
                                        </div>
                                    </template>
                                </ActionModal>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <DialogModal :show="confirmingUserDeletion" @close="closeModal">
            <template #title>
                Supprimer {{ selected_user_prenom }}
                {{ selected_user_nom }}</template
            >

            <template #content> Le client va être supprimer </template>

            <template #footer>
                <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>

                <DangerButton
                    class="ms-3"
                    :class="{
                        'opacity-25': form.processing,
                    }"
                    @click="deleteTechnicien()"
                >
                    Supprimer
                </DangerButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>
