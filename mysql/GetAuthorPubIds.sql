CREATE PROCEDURE GetAuthorPubIds(IN author_ids VARCHAR(255))
BEGIN
    SELECT GROUP_CONCAT(publication_author.pub_id) AS "pub_ids"
    FROM publication_author
    WHERE FIND_IN_SET(publication_author.author_id, author_ids);
END