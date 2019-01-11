function getXMLHttpRequest() {
	var xhr = null;
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest();
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	return xhr;
}

// Signalement d'un commentaire
function flagRequest(callback, commentID, userID) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText, commentID, userID);
		}
	};
  xhr.open("GET", "model/ajaxFlagComment.php?theComment=" + commentID + "&user_id=" + userID, true);
  xhr.send(null);
}

function flag(sData, commentID, userID) {
	$('.flagger').remove();
	if (sData == 'unflagged'){
		var button = '<input type="button" class="flagger button" id="'+ commentID + '" onclick="flagRequest(flag,'+ commentID + ','+ userID + ');" title="signaler ce commentaire comme offenssant ou innapproprié" value="Signaler" />';
		$('#flagger').html(button);
	}
	else{
		var button = '<input type="button" class="flagger button" id="'+ commentID + '" onclick="flagRequest(flag,'+ commentID + ','+ userID + ');" title="vous avez signalé ce commentaire, vous pouvez annuler ce signalement" value="Annuler le signalement" />';
		$('#flagger').html(button);
	}
}


// j'aime ou pas
function likeRequest(callback, postID, userID) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText, postID, userID);
		}
	};
  xhr.open("GET", "model/ajaxLikePost.php?thePost=" + postID + "&user_id=" + userID, true);
  xhr.send(null);
}

function like(sData, postID, userID) {
	$('.liker').remove();
	if (sData == 'unliked'){
		var button = '<input type="button" class="liker button" id="'+ postID + '" onclick="likeRequest(like,'+ postID + ','+ userID + ');" title="J\'aime" value="J\'aime" />';
		$('#liker').html(button);
	}
	else{
		var button = '<input type="button" class="liker button" id="'+ postID + '" onclick="likeRequest(like,'+ postID + ','+ userID + ');" title="Je n\'aime plus" value="Je n\'aime plus" />';
		$('#liker').html(button);
	}
}
