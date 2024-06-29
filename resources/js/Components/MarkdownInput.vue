<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}</label>
        <mavon-editor
            ref="editor"
            v-model="editorModel"
            :class="editorClass"
            :language="lang"
            font-size="16px"
            :box-shadow="false"
            :subfield="false"
            :placeholder="placeholder"
            :editable="editable"
            code-style="atom-one-dark"
            :autofocus="autofocus"
            :tab-size="2"
            :toolbars="toolbars"
            @imgAdd="uploadImage"
            v-bind="$attrs"
        />
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>


<script setup>
import axios from "axios";
import {computed, ref} from "vue";

const editorModel = defineModel({
    type: [String, null],
    required: true,
});

const editor = ref(null);

const props = defineProps({
    id: {
        type: String,
        default: () => `markdown-input-${Math.random().toString(36).substring(2, 9)}`
    },
    label: String,
    placeholder: {
        type: String,
        default: '輸入Markdown內容...',
    },
    short: {
        type: Boolean,
        default: false,
    },
    editable: {
        type: Boolean,
        default: true,
    },
    autofocus: {
        type: Boolean,
        default: false,
    },
    error: String,
});

const toolbars = computed(() => {
    return {
        bold: true, // 粗體
        italic: true, // 斜體
        header: true, // 標題
        underline: true, // 下劃線
        strikethrough: true, // 中劃線
        mark: false, // 標記
        superscript: false, // 上角標
        subscript: false, // 下角標
        quote: true, // 引用
        ol: true, // 有序列表
        ul: true, // 無序列表
        link: true, // 連結
        imagelink: true, // 圖片連結
        code: true, // code
        table: true, // 表格
        fullscreen: true, // 全螢幕編輯
        readmodel: false, // 沉浸式閱讀
        htmlcode: false, // HTML 原始碼
        help: false, // 幫助
        /* 1.3.5 */
        undo: false, // 上一步
        redo: false, // 下一步
        trash: false, // 清空
        save: false, // 儲存（觸發 events 中的 save 事件）
        /* 1.4.2 */
        navigation: false, // 導航目錄
        /* 2.1.8 */
        alignleft: false, // 左對齊
        aligncenter: false, // 居中
        alignright: false, // 右對齊
        /* 2.2.1 */
        subfield: true, // 單雙欄模式
        preview: true, // 預覽
    }
});

const editorClass = computed(() => {
    return {
        'disabled': !props.editable,
        'v-note-short': props.short,
    }
});

const lang = computed(() => {
    return document.documentElement.lang || 'zh-TW';
});

const uploadImage = async (pos, file) => {
    const formData = new FormData();
    form.append('image', file);
    axios.post('/upload/mavon-editor-image', formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        }
    }).then(({data: url}) => {
        editor.$img2Url(pos, url);
    })
}

</script>
