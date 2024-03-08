# Sistema de Edição de Registros

## `editar_registro.php`

Este arquivo PHP faz parte de um sistema que permite a um usuário autenticado editar um registro específico.

### Funcionalidades:

1. **Autenticação de Usuário:**
   - Verifica se o usuário está autenticado. Caso contrário, redireciona para a página de login.

2. **Verificação do ID do Registro:**
   - Obtém o ID do registro a ser editado a partir dos parâmetros da URL.
   - Verifica se o registro pertence ao usuário autenticado.

3. **Edição do Registro:**
   - Processa o formulário de edição quando enviado via método POST.
   - Atualiza os campos do registro no banco de dados.

4. **Redirecionamento Após Edição:**
   - Se a edição for bem-sucedida, redireciona o usuário de volta à página de pesquisa de registros.
   - Em caso de erro, exibe uma mensagem de erro.

5. **Formulário de Edição:**
   - Apresenta um formulário preenchido com os detalhes do registro para edição.
   - Envia os dados para a própria página (`editar_registro.php`) para processamento.

6. **Link de Volta:**
   - Inclui um link para retornar à página de pesquisa de registros.

### Licença

Este código está licenciado sob a [Licença MIT](https://opensource.org/licenses/MIT). Veja o arquivo `LICENSE.md` para obter mais detalhes.


## Licença MIT

O texto completo da Licença MIT pode ser encontrado no arquivo [LICENSE.md](LICENSE.md).
