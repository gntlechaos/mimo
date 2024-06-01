CREATE PROCEDURE GetPublicationStats(IN pub_ids VARCHAR(255))
BEGIN
    SELECT
        pub_id,
        COUNT(DISTINCT ip_address) AS 'unique_viewers',
        COUNT(ip_address) AS 'total_views',
        DATE(view_timestamp) AS 'view_dates',
        UNIX_TIMESTAMP(DATE(view_timestamp)) AS 'view_dates_unix_timestamp'
    FROM
        view
    WHERE
        FIND_IN_SET(pub_id, pub_ids)
    GROUP BY
        view_dates, pub_id;
END