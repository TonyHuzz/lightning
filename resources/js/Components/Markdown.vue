<template>
    <div class="markdown-body" v-html="renderedContent"></div>
</template>


<script setup>
import MarkdownIt from 'markdown-it';
import insert from 'markdown-it-ins';
import taskLists from 'markdown-it-task-lists';
import hljs from 'highlight.js';
import {computed} from "vue";

const props = defineProps({
    value: {
        type: String,
        required: true,
    },
});

const renderedContent = computed(() => {
    const markdown = new MarkdownIt({
        breaks: true,
        linkify: true,
        highlight(code, lang) {
            if (lang && hljs.getLanguage(lang)) {
                try {
                    return `<pre class="hljs"><code>${hljs.highlight(code, {
                        language: lang,
                        ignoreIllegals: true
                    }).value}</code></pre>`
                } catch (_) {
                }
            }

            return `<pre class="hljs"><code>${markdown.utils.escapeHtml(code)}</code></pre>`
        }
    })

    markdown
        .use(insert)
        .use(taskLists)

    return markdown.render(props.value);
})
</script>
