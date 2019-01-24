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
function flagRequest(callback, commentID, userID, sens) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText, commentID, userID);
		}
	};
  xhr.open("GET", "model/ajaxFlagComment.php?theComment=" + commentID + "&user_id=" + userID + "&sens=" + sens, true);
  xhr.send(null);
}

function flag(sData, commentID, userID) {
	$('.flagger').remove();
	if (sData == 'unflagged'){
		var button = '<input type="button" class="flagger button" id="'+ commentID + '" onclick="flagRequest(flag,'+ commentID + ','+ userID + ',\'up\');" title="signaler ce commentaire comme offenssant ou innapproprié" value="Signaler" />';
		$('#flagger').html(button);
	}
	else{
		var button = '<input type="button" class="flagger button" id="'+ commentID + '" onclick="flagRequest(flag,'+ commentID + ','+ userID + ',\'down\');" title="vous avez signalé ce commentaire, vous pouvez annuler ce signalement" value="Annuler le signalement" />';
		$('#flagger').html(button);
	}
}


// j'aime ou pas
function likeRequest(callback, postID, userID, sens) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText, postID, userID, sens);
		}
	};
  xhr.open("GET", "model/ajaxLikePost.php?thePost=" + postID + "&user_id=" + userID + "&sens=" + sens, true);
  xhr.send(null);
}

function like(sData, postID, userID) {
	$('.liker').remove();
	if (sData == 'unliked'){
		var button = '<input type="button" class="liker button" id="'+ postID + '" onclick="likeRequest(like,'+ postID + ','+ userID + ',\'up\');" title="J\'aime" value="J\'aime" />';
		$('#liker').html(button);
	}
	else{
		var button = '<input type="button" class="liker button" id="'+ postID + '" onclick="likeRequest(like,'+ postID + ','+ userID + ',\'down\');" title="Je n\'aime plus" value="Je n\'aime plus" />';
		$('#liker').html(button);
	}
}


// bannishing device (use with care, with great power comes great responsabilities )
function banRequest(callback, userID) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText, userID);
		}
	};
  xhr.open("GET", "model/ajaxBanUser.php?&user_id=" + userID, true);
  xhr.send(null);
}

function ban(sData, userID) {
	console.log(userID);
	$('#'+userID+' .bannisher').remove();
	if (sData == 'unbannished'){
		var button = '<input type="button" class="bannisher button" onclick="banRequest(ban,'+ userID + ',\'bannish\');" title="Bannir" value="Bannir" />';
		$('#'+userID).html(button);
	}
	else{
		var button = '<input type="button" class="bannisher button" onclick="banRequest(ban,'+ userID + ',\'unbannish\');" title="De-bannir" value="De-bannir" />';
		$('#'+userID).html(button);
	}
}
