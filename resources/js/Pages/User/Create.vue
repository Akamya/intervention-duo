<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps(["user"]);
const form = useForm({
    nom: "",
    prenom: "",
    email: "",
    password: "",
    // admin: "",
});
</script>

<template>
    <AppLayout title="Edit User">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create User
                </h2>
            </div>
        </template>

        <form @submit.prevent="form.post(route('users.store'))">
            <div class="flex flex-col">
                <!-- nom -->
                <input type="text" v-model="form.nom" placeholder="Nom" />
                <div v-if="form.errors.nom">{{ form.errors.nom }}</div>

                <input type="text" v-model="form.prenom" placeholder="Prenom" />
                <div v-if="form.errors.prenom">{{ form.errors.prenom }}</div>
                <!-- Email -->
                <input type="email" v-model="form.email" placeholder="Email" />
                <div v-if="form.errors.email">{{ form.errors.email }}</div>

                <!-- Password -->
                <input
                    type="password"
                    v-model="form.password"
                    placeholder="Mot de passe"
                />
                <div v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>

                <!-- Submit -->
                <button type="submit" :disabled="form.processing">Creer</button>
            </div>
        </form>
    </AppLayout>
</template>
