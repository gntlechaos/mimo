CREATE PROCEDURE SearchAuthorPublications(IN author_ids VARCHAR(255), IN title VARCHAR(255) COLLATE utf8mb4_general_ci)
BEGIN
  SELECT publication.pub_title, publication.pub_id, publication_url.url, GROUP_CONCAT(author.author_name) as author_names, GROUP_CONCAT(publication_author.author_id) as author_ids
  FROM publication
  INNER JOIN (
    SELECT MIN(publication_figure.fig_id) main_fig, publication_figure.pub_id
    FROM publication_figure
    GROUP BY publication_figure.pub_id
  ) b ON b.pub_id = publication.pub_id
  INNER JOIN figure ON figure.fig_id = b.main_fig
  INNER JOIN publication_url ON publication_url.pub_id = publication.pub_id
  INNER JOIN publication_author ON publication_author.pub_id = publication.pub_id
  INNER JOIN author ON author.author_id = publication_author.author_id
  WHERE FIND_IN_SET(publication_author.author_id, author_ids) AND publication.pub_title LIKE CONCAT('%', title, '%')
  GROUP BY publication.pub_id;
END
