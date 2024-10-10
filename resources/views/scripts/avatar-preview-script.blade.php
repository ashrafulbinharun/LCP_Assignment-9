<script>
    function previewImage() {
        const input = this.$refs.avatar;
        const reader = new FileReader();

        reader.onload = (e) => {
            this.avatarPreview = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
</script>
