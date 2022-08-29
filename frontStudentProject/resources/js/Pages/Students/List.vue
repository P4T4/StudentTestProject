<script setup>
import { UserCircleIcon, PencilIcon } from "@heroicons/vue/24/outline";
import Edit from "@/Pages/Students/Edit.vue";
defineProps({
    studentList: Array,
});
</script>

<template>
    <div class="flex justify-center mt-4">
        <div class="w-full max-w-2xl px-4">
            <div
                class="border rounded-lg border pb-6 border-gray-200 dark:border-gray-700"
            >
                <div
                    class="flex items-center border-b border-gray-200 dark:border-gray-700 justify-between px-6 py-3"
                >
                    <p
                        tabindex="0"
                        class="focus:outline-none text-sm lg:text-xl font-semibold leading-tight text-gray-800"
                    >
                        Estudiantes
                    </p>
                </div>
                <div class="px-6 pt-6 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <tbody>
                            <tr
                                v-for="student in studentList"
                                tabindex="0"
                                class="focus:outline-none"
                                :class="{ 'bg-red-100': student.active == 0 }"
                            >
                                <td>
                                    <div class="flex items-center">
                                        <div>
                                            <UserCircleIcon
                                                class="h-6 w-6"
                                                aria-hidden="true"
                                            />
                                        </div>
                                        <div class="pl-3">
                                            <div
                                                class="flex items-center text-sm leading-none"
                                            >
                                                <p
                                                    class="font-semibold text-gray-800"
                                                >
                                                    {{ student.full_name }}
                                                </p>
                                                <p
                                                    class="text-indigo-700 dark:text-indigo-400 ml-3"
                                                >
                                                    {{ student.age }}
                                                </p>
                                            </div>
                                            <p
                                                class="text-xs md:text-sm leading-none text-gray-600 mt-2"
                                            >
                                                {{ student.carrer }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="pl-16">
                                    <div>
                                        <div
                                            class="flex items-center justify-center px-2 py-1 mt-2 rounded-full"
                                        >
                                            <Edit :student="student" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
