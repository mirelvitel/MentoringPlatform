<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PostCard from "@/Components/PostCard.vue";
import { computed, ref } from "vue";
import { PlusCircleIcon } from "@heroicons/vue/20/solid";
import Highlight from "@tiptap/extension-highlight";
import Link from "@tiptap/extension-link";
import Bold from "@tiptap/extension-bold";
import Document from "@tiptap/extension-document";
import Paragraph from "@tiptap/extension-paragraph";
import Color from "@tiptap/extension-color";
import Underline from "@tiptap/extension-underline";
import { TextStyle } from "@tiptap/extension-text-style";
import HardBreak from "@tiptap/extension-hard-break";
import CustomClassMark from "@/Plugins/TipTapCustomClassExtension.js";
import { usePage } from "@inertiajs/vue3";
import { useEditor, EditorContent } from "@tiptap/vue-3";
import axios from "axios";
import { useColors } from "@/Config/colors.js";
import { useToast } from "vue-toastification";
import StarterKit from "@tiptap/starter-kit";
import NavLeft from "@/Shared/NavLeft.vue";

const colors = useColors();
const toast = useToast();
const page = usePage();
const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const displayForm = ref(false);
const title = ref("");

function savePost() {
    axios
        .post("/home/post", {
            title: title.value,
            content: editor.value.getHTML(),
        })
        .then((response) => {
            props.items.unshift(response.data);
            displayForm.value = false;
            toast.success("Post saved successfully");
            title.value = "";
            editor.value.commands.setContent("<p>Content here. 🎉</p>");
        })
        .catch((error) => {
            toast.error("An error occurred while saving the post");
        });
}

const user = computed(() => page.props.auth.user);

const editor = useEditor({
    content: "<p>Content here. 🎉</p>",
    extensions: [
        StarterKit,
        Highlight,
        Document,
        Bold,
        Text,
        Paragraph,
        Underline,
        TextStyle,
        CustomClassMark,
        /*Image.configure({
            //inline: true,
            HTMLAttributes: {
                class: 'rounded border-2 border-primary-300 p-2 mobile:w-full mx-auto my-4 max-h-[600px] w-auto max-w-2/3',
            },
            allowBase64: true,
            maxWidth: '100%',
            maxHeight: '600px',
        }),*/
        HardBreak.extend({
            addKeyboardShortcuts() {
                return {
                    Enter: () => this.editor.commands.setHardBreak(),
                };
            },
        }),
        Link,
        Color.configure({
            types: ["textStyle"],
        }),
    ],
    onCreate() {
        //document.querySelector('.ProseMirror').style.color = getColor('color1Dark')
    },
});

const baseBtnClasses = "rounded-xl border px-2 m-0.5 text-primary-100";
function getButtonClasses(isActive, isDisabled = false) {
    if (isDisabled) {
        return `${baseBtnClasses} bg-primary-300 text-primary-700 cursor-not-allowed`;
    } else if (isActive) {
        return `${baseBtnClasses} bg-primary-700 hover:bg-primary-500`;
    } else {
        return `${baseBtnClasses} bg-primary-900 hover:bg-primary-700`;
    }
}

function getColor(color) {
    return {
        color1: colors.primary["500"],
        color1Dark: colors.primary["900"],
        color2: colors.secondary["500"],
        color2Dark: colors.secondary["900"],
        color3: colors.third["500"],
        color3Dark: colors.third["900"],
        color4: colors.forth["500"],
        color4Dark: colors.forth["900"],
        color5: colors.fifth["500"],
        color5Dark: colors.fifth["900"],
        pink: colors.pink["500"],
    }[color];
}

function setFontSize(c) {
    editor.value.commands.setCustomClass({ class: c });
}

function deletePost(id) {
    if (!confirm("Are you sure you want to delete this post?")) {
        return;
    }

    axios
        .delete(`/home/post/${id}`)
        .then(() => {
            for (let i = 0; i < props.items.length; i++) {
                if (props.items[i].id === id) {
                    props.items.splice(i, 1);
                    break;
                }
            }
            toast.success("Post deleted successfully");
        })
        .catch(() => {
            toast.error("An error occurred while deleting the post");
        });
}
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex">

            <NavLeft />

            <div class="flex flex-col mx-6 content-width--400 px-2 w-full">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl text-gray-500">POSTS</h1>
                    <button @click="displayForm = true" class="flex space-x-2 text-primary font-semibold">
                        <PlusCircleIcon class="w-6 h-6" />
                        <span>Create new Post</span>
                    </button>
                </div>
                <div class="scrollable-posts-container">
                    <PostCard
                        v-for="item in items"
                        @delete-post="deletePost"
                        :post="item"
                        :user="user"
                    ></PostCard>
                </div>
                <div
                    class="form fixed inset-0 bg-gray-800 bg-opacity-25 flex items-center justify-center"
                    v-if="displayForm"
                >
                    <div
                        class="bg-white shadow border border-primary p-12 rounded-lg min-w-[500px]"
                    >
                        <div class="form-group flex flex-col mb-4 w-full">
                            <div class="flex flex-wrap">
                                <button
                                    @click="
                                        editor
                                            .chain()
                                            .focus()
                                            .toggleBold()
                                            .run()
                                    "
                                    :class="
                                        getButtonClasses(
                                            editor.isActive('bold')
                                        )
                                    "
                                >
                                    Toggle Bold
                                </button>
                                <button
                                    @click="
                                        editor
                                            .chain()
                                            .focus()
                                            .toggleItalic()
                                            .run()
                                    "
                                    :class="
                                        getButtonClasses(
                                            editor.isActive('italic')
                                        )
                                    "
                                >
                                    Toggle Italic
                                </button>
                                <button
                                    @click="
                                        editor
                                            .chain()
                                            .focus()
                                            .toggleStrike()
                                            .run()
                                    "
                                    :class="
                                        getButtonClasses(
                                            editor.isActive('strike')
                                        )
                                    "
                                >
                                    Toggle Strike
                                </button>
                                <button
                                    @click="
                                        editor
                                            .chain()
                                            .focus()
                                            .toggleUnderline()
                                            .run()
                                    "
                                    :class="
                                        getButtonClasses(
                                            editor.isActive('underline')
                                        )
                                    "
                                >
                                    Toggle Underline
                                </button>
                            </div>

                            <div class="flex flex-wrap">
                                <button
                                    v-for="color in [
                                        'color1',
                                        'color1Dark',
                                        'color2',
                                        'color2Dark',
                                        'color3',
                                        'color3Dark',
                                        'color4',
                                        'color4Dark',
                                        'color5',
                                        'color5Dark',
                                        'pink',
                                    ]"
                                    :key="color"
                                    @click="
                                        editor
                                            .chain()
                                            .focus()
                                            .setColor(getColor(color))
                                            .run()
                                    "
                                    :class="{
                                        'is-active': editor.isActive(
                                            'textStyle',
                                            { color: getColor(color) }
                                        ),
                                    }"
                                    :style="{
                                        backgroundColor: getColor(color),
                                    }"
                                    class="w-8 h-8 rounded-full m-1"
                                    :aria-label="`Set text color to ${color}`"
                                ></button>
                            </div>

                            <div class="flex flex-wrap">
                                <template
                                    v-for="c in [
                                        'text-sm',
                                        'text-base',
                                        'text-xl',
                                        'text-2xl',
                                        'text-3xl',
                                        'text-4xl',
                                        'text-5xl',
                                    ]"
                                >
                                    <button
                                        @click="setFontSize(c)"
                                        class="rounded-xl text-sm border m-1 bg-secondary-400 px-2"
                                    >
                                        {{ c }}
                                    </button>
                                </template>
                            </div>

                            <div class="flex items-center my-4">
                                <label
                                    for="title"
                                    class="text-gray-700 font-semibold mr-4"
                                    >Title</label
                                >
                                <input
                                    type="text"
                                    id="title"
                                    v-model="title"
                                    class="border border-gray-300 rounded p-2 w-full"
                                />
                            </div>

                            <editor-content :editor="editor" />
                        </div>

                        <button
                            @click="savePost()"
                            class="bg-secondary py-1 text-white transition-all hover:bg-green-600 px-4 rounded"
                        >
                            Create
                        </button>
                        <button
                            @click="displayForm = false"
                            class="py-1 text-white ml-4 bg-red-500 transition-all hover:bg-red-600 px-4 rounded"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <div v-if="user.role === 'admin'" class="summary w-[200px]">
                <h1 class="text-xl text-gray-500">REPORTS SUMMARY</h1>
            </div>
        </div>
    </AppLayout>
</template>
<style lang="scss">
.ProseMirror {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 4px;
    min-height: 500px;
}

.tiptap {
    > * + * {
        margin-top: 0.75em;
    }

    img {
        &.ProseMirror-selectednode {
            outline: 3px solid #68cef8;
        }
    }
}
</style>
