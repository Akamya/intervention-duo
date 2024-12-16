<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps(["id"]);
const form = useForm({
    title: "",
    comment: "",
    img_path: "",
    // admin: "",
});
</script>

<template>
    <AppLayout title="Create intervention">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Créer Intervention
                </h2>
            </div>
        </template>

        <form @submit.prevent="form.post(route('interventions.store', id))">
            <div class="flex flex-col">
                <!-- nom -->
                <input type="text" v-model="form.title" placeholder="title" />
                <div v-if="form.errors.title">{{ form.errors.title }}</div>

                <input
                    type="text"
                    v-model="form.comment"
                    placeholder="comment"
                />
                <div v-if="form.errors.prenom">{{ form.errors.comment }}</div>

                <input
                    type="text"
                    v-model="form.img_path"
                    placeholder="Entrez l'URL de l'image"
                />
                <div v-if="form.errors.img_path" class="text-red-500">
                    {{ form.errors.img_path }}
                </div>
                <!-- Submit -->
                <button type="submit" :disabled="form.processing">Creer</button>
            </div>
        </form>
    </AppLayout>
</template>
