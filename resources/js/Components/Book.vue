<script>
export default {
    data() {
        return {
            mostReadBooks: [
                {
                    image: "/assets/images/just_one_thing.jpg",
                    title: "Just One Thing",
                    author: "Dr. Michael Mosley",
                },
                {
                    image: "/assets/images/atomic_habits.jpg",
                    title: "Atomic Habits",
                    author: "James Clear",
                },
                {
                    image: "/assets/images/failing-forward.jpg",
                    title: "Failing Forward",
                    author: "John C. Maxwell",
                },
            ],
        };
    },
};
</script>

<template>
    <div class="summary w-full pl-2 mt-3">
        <ul>
            <li
                v-for="(book, index) in mostReadBooks"
                :key="index"
                class="mb-4 flex items-start"
            >
                <img :src="book.image" alt="" class="w-26 h-36 mr-4 border" />
                
            </li>
        </ul>
    </div>
</template>
