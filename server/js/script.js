function abrirModal(id_profissional) {
     let modal = document.getElementById(`modalAvaliacao_${id_profissional}`);

     if (modal) {
          modal.style.display = "block";
     } else {
          console.error("Modal não encontrado para o profissional ID: " + id_profissional);
     }

}

function fecharModal(idProfissional) {
     document.getElementById(`modalAvaliacao_${idProfissional}`).style.display = 'none';
}


function enviarAvaliacao(id) {
     let nota = document.getElementById(`nota_${id}`).value;
     let comentario = document.getElementById(`comentario_${id}`).value;

     fetch('avaliar_profissional.php', {
          method: 'POST',
          headers: {
               'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `id_profissional=${id}&nota=${nota}&comentario=${encodeURIComponent(comentario)}`
     })
          .then(response => response.text())
          .then(data => {
               alert(data);
               document.getElementById(`modalAvaliacao_${id}`).style.display = "none";
          })
          .catch(error => console.error('Erro ao enviar avaliação:', error));
}



function abrirModalMensagem(idProfissional) {
     document.getElementById(`modalMensagem_${idProfissional}`).style.display = 'block';
}

function fecharModalMensagem(idProfissional) {
     document.getElementById(`modalMensagem_${idProfissional}`).style.display = 'none';
}

function enviarMensagem(idProfissional) {
     let mensagem = document.getElementById(`mensagem_${idProfissional}`).value;

     if (mensagem.trim() === '') {
          alert("Digite uma mensagem antes de enviar.");
          return;
     }

     fetch('../server/enviar-mensagem.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `id_profissional=${idProfissional}&mensagem=${encodeURIComponent(mensagem)}`
     })
          .then(response => response.text())
          .then(data => {
               alert(data);
               fecharModalMensagem(idProfissional);
          })
          .catch(error => console.error("Erro ao enviar mensagem:", error));
}

window.onclick = function (event) {
     let modais = document.querySelectorAll(".modal");
     modais.forEach((modal) => {
          if (event.target === modal) {
               modal.style.display = "none";
          }
     });
};

window.abrirModal = abrirModal;
