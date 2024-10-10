<script>
    function imageUpdate(hasExistingImage) {
        return {
            imagePreview: null,
            hasExistingImage: hasExistingImage,
            removeExistingImage: false,

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                    this.hasExistingImage = false;
                    this.removeExistingImage = false;
                }
            },

            removeImage() {
                this.imagePreview = null;
                if (this.hasExistingImage) {
                    this.removeExistingImage = true;
                }
                this.$refs.pictureInput.value = null;
                this.hasExistingImage = false;
            }
        }
    }
</script>
