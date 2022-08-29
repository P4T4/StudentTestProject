<script setup>
import { ref, reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";
import Modal from "@/Components/Modal.vue";
import { PencilIcon } from "@heroicons/vue/24/outline";
import BreezeInput from "@/Components/Input.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";

const obj = reactive({});
const open = ref(false);
obj.open = open;

const props = defineProps({
    student: Object,
});
const form = useForm({
    id: props.student.id,
    full_name: props.student.full_name,
    age: props.student.age,
    carrer: props.student.carrer,
    active: props.student.active,
});
const fail = function () {
    obj.open = false;
};
const success = () => {
    form.post(route("student_update"), {
        onFinish: () => {
            form.reset("full_name", "age", "carrer");
            fail();
        },
    });
};
const deleteCustom = () => {
    form.post(route("student_delete"), {
        onFinish: () => {
            fail();
        },
    });
};
</script>

<template>
    <BreezeButton @click="open = !open">
        <PencilIcon class="h-4 w-4 mr-2" aria-hidden="true" />Editar
    </BreezeButton>
    <Modal :open="open" @close="open = false">
        <template #icon>
            <PencilIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
        </template>
        <template #title>Editar estudiante</template>
        <template #content>
            <form @submit.prevent="success">
                <div>
                    <BreezeLabel for="full_name" value="Nombre completo" />
                    <BreezeInput
                        id="full_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.full_name"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <BreezeInputError
                        class="mt-2"
                        :message="form.errors.full_name"
                    />
                </div>
                <div>
                    <BreezeLabel for="age" value="Edad" />
                    <BreezeInput
                        id="age"
                        type="number"
                        min="0"
                        max="99"
                        class="mt-1 block w-full"
                        v-model="form.age"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <BreezeInputError class="mt-2" :message="form.errors.age" />
                </div>
                <div>
                    <BreezeLabel for="carrer" value="Nombre de la carrera" />
                    <BreezeInput
                        id="carrer"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.carrer"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <BreezeInputError
                        class="mt-2"
                        :message="form.errors.carrer"
                    />
                </div>
            </form>
        </template>
        <template #buttons>
            <button
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                @click="success()"
            >
                Editar
            </button>
            <button
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                @click="fail()"
                ref="cancelButtonRef"
            >
                Cancel
            </button>
            <button
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                @click="deleteCustom()"
            >
                Eliminar
            </button>
        </template>
    </Modal>
</template>
