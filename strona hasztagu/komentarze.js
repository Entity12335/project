 function addComment() {
            var commentText = document.getElementById('tekstKomentarza').value;
            var commentNode = document.createElement('div');
            commentNode.className = 'comment';
            commentNode.innerHTML = '<p>' + commentText + '</p>';
            document.getElementById('komentarze').appendChild(commentNode);
            document.getElementById('tekstKomentarza').value = ''; // Czyszczenie pola po dodaniu komentarza
        }