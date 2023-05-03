if (getOTPfunc)
{
    //MessageBox.Show("Lấy mã OTP thành công. Mã OTP của bạn là: " + codeSms);
    if (SubmitOTP(dtsg, jaz, codeSms, eav, contentType, userAgent, cookie, true, ip))
    {
        gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor = Color.Green;
        gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value = "Code OK " + codeSms;

        // disagree
        string datadis =
            "fb_dtsg=" + dtsg + "&jazoest=" + jaz + "&action_proceed=Disagree+with+decision";
        string post_datadis = request
            .Post(
                "https://mbasic.facebook.com/checkpoint/1501092823525282/submit/?next=https%3A%2F%2Fmbasic.facebook.com%2F&paipv=0&eav="
                    + eav,
                datadis,
                contentType
            )
            .ToString();

        // check form ảnh
        gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor = Color.Green;
        gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
            "Check form Upload ảnh...";
        string check2 = request
            .Get("https://mbasic.facebook.com/checkpoint/1501092823525282/")
            .ToString();
        if (check2.Contains("action_upload_image"))
        {
            // thực hiện upload ảnh lên
            bool upanh = UploadIMG(uid, dtsg, jaz, eav, contentType, userAgent, cookie, true, ip);
            if (upanh)
            {
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor =
                    Color.Green;
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
                    "Request UploadIMG done... checking";
                string checkimg = request
                    .Get("https://mbasic.facebook.com/checkpoint/1501092823525282/")
                    .ToString();
                if (checkimg.Contains("decision"))
                {
                    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor =
                        Color.Green;
                    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
                        "Up Ảnh OK>282 Success!";

                    File.Delete(@"imgacc\" + uid + ".jpg");
                    try
                    {
                        using (StreamWriter streamWriter = new StreamWriter("282_ok.txt", true))
                        {
                            streamWriter.WriteLine(
                                uid + "|" + pass + "|" + getCookie1 + "|" + mail + "|"
                            );
                            streamWriter.Close();
                        }
                    }
                    catch { }
                    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor =
                        Color.Green;
                    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
                        "282 Success>Lưu File OK";
                }
                else
                {
                    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor =
                        Color.Red;
                    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
                        "Up Ảnh thất bại";
                }
            }
            else
            {
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor =
                    Color.Red;
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
                    "Lỗi truy vấn up ảnh";
                return;
            }
        }
        else
        {
            gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor =
                Color.Red;
            gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
                "Không tìm thấy form up ảnh!";

            string checkliveuid = request
                .Get("https://graph.facebook.com/" + uid + "/picture?type=normal")
                .ToString();
            gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor =
                Color.BlueViolet;
            gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
                "Kiểm tra lại UID....";

            if (checkliveuid.Contains("Photoshop"))
            {
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[6].Style.ForeColor =
                    Color.BlueViolet;
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[6].Value =
                    uid + " -> LIVE | Veri phone live";
                try
                {
                    using (
                        StreamWriter streamWriter = new StreamWriter("veri-phone-live.txt", true)
                    )
                    {
                        streamWriter.WriteLine(uid + "|" + pass + "|" + getCookie1);
                        streamWriter.Close();
                    }
                }
                catch { }
            }
            else
            {
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[6].Style.ForeColor =
                    Color.Red;
                gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[6].Value =
                    uid + " -> Die";
            }

            return;
        }
    }
    else
    {
        gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor = Color.Red;
        gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value =
            "Code False" + codeSms;
    }
}
else
{
    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Style.ForeColor = Color.Red;
    gridviewaddthe.Rows[Convert.ToInt32(mangdstrue[vt])].Cells[5].Value = "Không về code";
    return;
}
