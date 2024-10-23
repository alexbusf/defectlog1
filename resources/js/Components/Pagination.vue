.vue looks like:

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap mt-8">
            <template v-for="(link, key) in visibleLinks" :key="key">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
                    :class="{ 'bg-blue-700 text-white': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from '@inertiajs/vue3';

export default defineComponent({
    components: {
        Link,
    },
    props: {
        links: Array,
    },
    computed: {
        visibleLinks() {
            const maxVisibleButtons = 5;
            const halfRange = Math.floor(maxVisibleButtons / 2);
            const activeIndex = this.links.findIndex(link => link.active);
            
            let start = Math.max(activeIndex - halfRange, 0);
            let end = Math.min(activeIndex + halfRange, this.links.length - 1);

            // Correct if we're near the start or end
            if (end - start < maxVisibleButtons - 1) {
                if (start === 0) {
                    end = Math.min(start + maxVisibleButtons - 1, this.links.length - 1);
                } else {
                    start = Math.max(end - (maxVisibleButtons - 1), 0);
                }
            }

            // Always show the first and last page
            const paginatedLinks = [];

            if (start > 0) paginatedLinks.push(this.links[0]); // First page
            if (start > 1) paginatedLinks.push({ label: '...', url: null }); // Ellipsis before current range

            paginatedLinks.push(...this.links.slice(start, end + 1));

            if (end < this.links.length - 2) paginatedLinks.push({ label: '...', url: null }); // Ellipsis after current range
            if (end < this.links.length - 1) paginatedLinks.push(this.links[this.links.length - 1]); // Last page

            return paginatedLinks;
        }
    },
});
</script>