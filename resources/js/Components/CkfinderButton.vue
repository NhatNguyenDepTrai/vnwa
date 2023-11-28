<template>
    <div>
        <button @click="openCKFinder">Mở CKFinder</button>
        <input id="inputImage" v-model="imageUrlInput" type="text" placeholder="Image URL">
        <img :src="imageUrlInput" alt="ádg">
    </div>
</template>

<script>
export default {
    data() {
        return {
            imageUrlInput: '', // Biến để lưu giữ giá trị URL của ảnh
        };
    },
    methods: {
        openCKFinder() {
            CKFinder.popup({
                chooseFiles: true,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        const file = evt.data.files.first();
                        const imageUrl = file.getUrl();
                        document.getElementById('inputImage').value = imageUrl;


                    });
                }
            });
        }
    }
}
</script>
