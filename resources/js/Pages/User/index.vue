<script setup>
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
// const props = defineProps(["users"]);
import NavLink from "@/Components/NavLink.vue";

//MODAL
import DialogModal from "@/Components/DialogModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ActionModal from "@/Components/ActionModal.vue";

import { useForm, usePage } from "@inertiajs/vue3";

let selected_user_id = 0;
let selected_user_nom = "";
const props = defineProps(["users"]);
const form = useForm(props);

//UPDATE
function update(id) {
    form.put(route("users.update", id));
}

// DELETE AVEC MODAL

const confirmingUserDeletion = ref(false);

const confirmUserDeletion = (id, nom) => {
    selected_user_id = id;
    selected_user_nom = nom;
    confirmingUserDeletion.value = true;
};
// console.log(usePage().props.user.id);

function deleteTechnicien() {
    form.delete(route("users.destroy", selected_user_id), {
        onSuccess: () => closeModal(),
    });
}
const closeModal = () => {
    confirmingUserDeletion.value = false;
};
</script>

<template>
    <AppLayout title="Technicien">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des Techniciens
            </h2>
        </template>

        <NavLink class="mt-4 text-white" :href="route('users.create')">
            <button class="py-4 px-6 rounded-lg ml-4 bg-blue-400">Créer</button>
        </NavLink>

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
                        <th class="px-4 py-2 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="">
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
                            <form @submit.prevent="update(user.id)">
                                <button
                                    type="submit"
                                    @click="update(user.id)"
                                    :class="{
                                        ' text-green-600 font-bold':
                                            user.is_admin,
                                        ' text-red-600 font-bold':
                                            !user.is_admin,
                                    }"
                                >
                                    {{ user.is_admin ? "Oui" : "Non" }}
                                </button>
                            </form>
                        </td>

                        <td>
                            <ActionModal>
                                <template #content>
                                    <div class="">
                                        <DangerButton
                                            @click="
                                                confirmUserDeletion(
                                                    user.id,
                                                    user.nom
                                                )
                                            "
                                        >
                                            Supprimer Technicien
                                        </DangerButton>
                                    </div>
                                    <!-- {{ user.nom }} -->
                                    <!-- Delete Account Confirmation Modal -->
                                </template>
                            </ActionModal>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <DialogModal :show="confirmingUserDeletion" @close="closeModal">
            <template #title>
                Supprimer Utilisateur : {{ selected_user_nom }}</template
            >

            <template #content> Le technicien va etre supprimer </template>

            <template #footer>
                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                <DangerButton
                    class="ms-3"
                    :class="{
                        'opacity-25': form.processing,
                    }"
                    @click="deleteTechnicien()"
                >
                    Supprimer Technicien
                </DangerButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>
<!-- <td
                            class="px-4 py-2 text-red-600"
                            @click="
                                () =>
                                    $inertia.delete(
                                        route('users.destroy', user.id)
                                    )
                            "
                        >
                            <button>Supprimer</button>
                        </td> -->
