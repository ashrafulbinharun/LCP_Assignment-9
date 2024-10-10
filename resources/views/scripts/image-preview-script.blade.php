<script>
    function imagePreview() {
        return {
            imagePreview: null,

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                }
            },

            removeImage() {
                this.imagePreview = null;
                this.$refs.pictureInput.value = null;
            }
        }
    }
</script>
