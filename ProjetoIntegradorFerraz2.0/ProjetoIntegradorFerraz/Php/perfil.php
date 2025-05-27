<?php include "navbar.php"; include "database.php"; ?>
<main>
    <div class="form-container">
      <div class="form-card">
        <h2>Seus Dados</h2>
        <p class="form-subtitle">Abra sua conta grátis</p>
        <?php
            $id = $_SESSION['id'];
            $dados = mysqli_query($conexao, "SELECT * FROM cadastro WHERE id = '$id'");
            if (mysqli_num_rows($dados) > 0) {
                $row = mysqli_fetch_assoc($dados);
                echo "<table>";
                echo "<tr><th>Id</th><th>Nome</th><th>Email</th></tr>";
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                    echo "</table>";
            } else {
                echo "ERRO";
            }
            ?>
         
          
          
          </div>
        </table>
      </div>
    </div>
  </main>
<?php include "footer.php"; ?>
