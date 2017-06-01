<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  ~ Copyright (c) 2017. Mori7 Technologie inc. Tous droits réservés.          ~
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<script>
    export default {
        methods: {
            readNotification(id, unread) {
                if (!unread) {
                    return;
                }

                axios.delete(`/dashboard/notifications/${id}`);
            }
        }
    };
</script>