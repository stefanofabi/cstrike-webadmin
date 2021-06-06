<script type="text/javascript">
    function destroyPlayer(player_id){
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('destroy_player_'+player_id);
            form.submit();
        }
    }
</script>