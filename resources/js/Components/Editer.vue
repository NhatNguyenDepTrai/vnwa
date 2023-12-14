<style>
.ck-editor__editable {
    min-height: 300px;
    /* Đặt chiều cao tối thiểu ở đây */
}
</style>
<template>
    <div>

        <ckeditor v-model="editer_data" :editor="editor" @ready="onReady"></ckeditor>
    </div>
</template>

<script>
import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
import { ref, watchEffect } from 'vue';

export default {
    name: 'Editer',
    data() {
        return {
            editor: DecoupledEditor,

        };
    },
    props: { data: String },
    methods: {
        onReady(editor) {
            editor.ui.getEditableElement().parentElement.insertBefore(
                editor.ui.view.toolbar.element,
                editor.ui.getEditableElement()
            );

            // Thêm trình xử lý sự kiện khi người dùng chọn tệp tin để tải lên
            editor.plugins.get('FileRepository').createUploadAdapter = loader => {

                return {
                    upload() {
                        return loader.file
                            .then(file => {
                                const formData = new FormData();
                                formData.append('file', file);


                                return axios.post('/ckediter-uploads-file', formData)
                                    .then(response => {
                                        // Trả về đối tượng với URL tệp tin đã tải lên
                                        return { default: response.data.url };
                                    })
                                    .catch(error => {
                                        console.error('Error during file upload', error.response);
                                        throw error;
                                    });
                            });
                    },

                    abort() {
                        // Thực hiện xử lý khi người dùng hủy tải lên
                        console.log('Upload aborted');
                    },
                };
            };
        },
    },
    setup(props) {
        const editer_data = ref('');

        watchEffect(() => {
            editer_data.value = props.data;
        });


        return {
            editer_data

        };
    },
};
</script>
