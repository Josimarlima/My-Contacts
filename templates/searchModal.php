<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>




<!-- Modal de resultados da pesquisa -->
<div class="modal fade" id="searchResultsModal" tabindex="-1" role="dialog" aria-labelledby="searchResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchResultsModalLabel">Resultados da Pesquisa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (empty($searchName) && empty($searchLastname) && empty($searchPhone)) : ?>
                    <p>Digite algo para realizar a pesquisa.</p>
                <?php else : ?>
                    <?php if (count($contacts) > 0) : ?>
                        <table class="table" id="search-results-table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Sobrenome</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contacts as $contact) : ?>
                                    <tr>
                                        <td><?= $contact["name"] ?></td>
                                        <td><?= $contact["lastname"] ?></td>
                                        <td><?= $contact["phone"] ?></td>
                                        <td class="actions">
                                            <a href="<?= $BASE_URL ?>show.php?id=<?= $contact['id'] ?>"><i class="fas fa-eye check-icon"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>Nenhum contato encontrado.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#search-button').addEventListener('click', function(event) {
            event.preventDefault();

            var searchType = document.getElementById('search-type').value;
            var searchInput = document.getElementById('search-input').value.trim();

            if (searchType !== '' && searchInput !== '') {
                updateSearchResultsModal(searchType, searchInput);
            } else {
                var modalBody = document.querySelector('#searchResultsModal .modal-body');
                modalBody.innerHTML = '<p>Selecione um tipo e digite algo para realizar a pesquisa.</p>';
                $('#searchResultsModal').modal('show');
            }
        });
    });

    function updateSearchResultsModal(type, input) {
        var modalBody = document.querySelector('#searchResultsModal .modal-body');
        var xhr = new XMLHttpRequest();

        var url = `config/searchLogic.php?search-type=${type}&search-input=${input}&search-submit=1`;

        console.log('URL:', url); // para depuração

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    modalBody.innerHTML = xhr.responseText;
                } else {
                    modalBody.innerHTML = '<p>Erro ao buscar resultados.</p>';
                }
                $('#searchResultsModal').modal('show');
            }
        };

        xhr.send();
    }
</script>