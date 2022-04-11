$('#tableForumComment').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/tables/forum-comments',
        data : {
            status : getUrlParameter('status')
        }
    },
    "language": {
        "url": "/admin_files/plugins/jquery-datatable/language-tr.json"
    },
    columns: [
        {data: 'id', name: 'id', title: 'ID'},
        {
            data: 'forum_id', name: 'forum_id', title: 'Forum',
            render: function (data, type, row) {
                return data
                    ? `<a href="/admin/forum/comments/edit/${row['id']}">${row['forum']['title']}</a>`
                    : ''
            },
        },
        {
            data: 'comment', name: 'comment', title: 'Yorum',
            render: function (data, type, row) {
                return data.substr(0,80) + ".."
            },
        },
        {
            data: 'status', name: 'status', title: 'Durum',
            render: function (data, type, row) {
                return row['status_label']
            },
        },
        {
            data: 'user_id', name: 'user_id', title: 'Oluşturan', visible: window.IS_ADMIN,
            render: function (data, type, row) {
                return row['user']
                    ? `<a href="/admin/user/edit/${row['user_id']}">${row['user']['full_name']}</a>`
                    : '-'
            }
        },
        {
            data: 'updated_at', name: 'updated_at', title: 'Güncelleme',
            render: function (data, type, row) {
                return createdAt(data)
            }
        },
        {
            data: 'created_at', name: 'created_at', title: 'Oluşturma',
            render: function (data, type, row) {
                return createdAt(data)
            }
        },
        {
            data: 'id', name: 'id', orderable: false,
            render: function (data) {
                return `<a href='/admin/forum/comments/edit/${data}'><i class='fa fa-edit'></i></a> &nbsp;` +
               ( window.IS_ADMIN
                    ? `<a href="#" class="delete-item" data-id="${data}"><i class='fa fa-trash text-danger'></i></a>`
                    : '')
            }
        }
    ],
    order: [0, 'desc'],
    pageLength: 10
});


/**
 *  delete for blog
 */
$('#tableForumComment').on('click', '.delete-item', function () {
    if (confirm('Silmek istediğine emin misin ? ')) {
        // $(this).parent().parent().remove()
        const id = $(this).data('id')
        const self = this;
        console.log(id);
        $.ajax({
            url: `/admin/forum/comment/${id}`,
            dataType: 'json',
            method: 'DELETE',
            success: function (data) {
                $(self).parent().parent().css('background-color', 'red')
                    .fadeOut(600, function () {
                        this.remove();
                    });
            },
            error: function (xhr, error) {
                console.log(xhr)
                errorMessage(xhr)
                console.log(error)
            }
        })
    }
});
