<?php echo "<form action='sendcomment.php?id=".$id_obra."' id='hcb' method='post'>"; ?>

<p><u><b>Comentarios:</b></u></p>

<?php if($user != 0){ ?>

<textarea id="comment" required value="comment" name="comment" oninput="censura()" placeholder="Escribe un comentario..." maxlength="100" rows="10" cols="50" onFocus="if(this.value=='comment')this.value='' "></textarea>

<br/><br/><input type="submit" name="enviar" value="Enviar"><br/>

<?php }?>

<div class="scroll">

    <?php
        
            echo "</br>";
            echo "<hr/>";
        
        ?>

        <div id="ListaComentarios"></div>

        <?php
        
        while($array_resultado_comentarios = mysqli_fetch_assoc($resultado_comentarios)) {
            
            echo "<b>".$array_resultado_comentarios["Nombre"]."</b>"."</br></br><b>".$array_resultado_comentarios["Fecha"]."</b>"."<p>".$array_resultado_comentarios["Texto"]."</p>";
            
        if($user == 2 ||$user == 4){    
            
            echo "<a class='fa fa-eraser' title='Borrar' href='borrarComentarios.php?id=".$array_resultado_comentarios["id_comentario"]."'></a>&nbsp&nbsp&nbsp<a class='fa fa-file-text' title='Editar' href='editarComentarios.php?id=".$array_resultado_comentarios["id_comentario"]."'></a>";
        }
            echo "<hr />";
      }
        
        ?>

</div>
<?php echo "</form>"; ?>
