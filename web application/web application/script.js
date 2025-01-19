// Handle dynamic comment editing
document.addEventListener("DOMContentLoaded", () => {
  // Edit comment functionality
  document.querySelectorAll(".edit-comment").forEach((button) => {
    button.addEventListener("click", () => {
      const commentId = button.dataset.commentId;
      const commentContainer = document.querySelector(`#comment-${commentId}`);
      const currentContent = commentContainer.querySelector(".content").textContent;

      // Prompt the user for new comment content
      const newContent = prompt("Edit your comment:", currentContent);
      if (newContent && newContent !== currentContent) {
        // Send AJAX request to update comment
        fetch("process_comments.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `edit_comment=true&comment_id=${commentId}&new_comment=${encodeURIComponent(
            newContent
          )}`,
        })
          .then((response) => response.text())
          .then((data) => {
            alert(data); // Feedback to the user
            commentContainer.querySelector(".content").textContent = newContent;
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }
    });
  });

  // Delete comment functionality
  document.querySelectorAll(".delete-comment").forEach((button) => {
    button.addEventListener("click", () => {
      const commentId = button.dataset.commentId;

      // Confirm deletion
      if (confirm("Are you sure you want to delete this comment?")) {
        // Send AJAX request to delete comment
        fetch("process_comments.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `delete_comment=true&comment_id=${commentId}`,
        })
          .then((response) => response.text())
          .then((data) => {
            alert(data); // Feedback to the user
            // Remove the comment from the DOM
            document.querySelector(`#comment-${commentId}`).remove();
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }
    });
  });

  // Upload image preview
  const imageInput = document.getElementById("image-input");
  const imagePreview = document.getElementById("image-preview");

  if (imageInput && imagePreview) {
    imageInput.addEventListener("change", () => {
      const file = imageInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          imagePreview.src = e.target.result;
          imagePreview.style.display = "block";
        };
        reader.readAsDataURL(file);
      } else {
        imagePreview.style.display = "none";
      }
    });
  }
});
