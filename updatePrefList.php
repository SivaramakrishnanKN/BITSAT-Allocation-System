create or replace trigger p3 after insert on collegebranch for each row
declare num NUMBER;
BEGIN
SELECT regno from student;
SELECT count(*) into num from collegebranch;
insert into studentpreference values(regno,$_SESSION['sess_campus'],$_SESSION['sess_branch'],num);
end;
