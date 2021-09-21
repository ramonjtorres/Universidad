package com.monkeybit.routability;

import android.app.Activity;
import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.VolleyError;

import org.json.JSONObject;

import java.util.List;

public class CommentsAdapter extends RecyclerView.Adapter<CommentsAdapter.CommentsViewHolder> implements AlertDialogResponseInterface, DBConnectInterface{

    private List<Comments> comments;
    private Activity activity;
    private String message;
    private String messageOk;
    private String idPlaceRoute;
    private String email;
    private String date;
    private String time;
    private Context context;
    private Boolean isPlace;

    public CommentsAdapter (List<Comments> comments, Activity activity, String message, String messageOk, String idPlaceRoute, Boolean isPlace ) {
        this.comments = comments;
        this.activity = activity;
        this.message = message;
        this.idPlaceRoute = idPlaceRoute;
        this.messageOk = messageOk;
        this.isPlace = isPlace;
    }

    @NonNull
    @Override
    public CommentsViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int i) {

        //View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_comments,parent,false);

        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_comments,null,false);

        return new CommentsViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull final CommentsViewHolder commentsViewHolder, final int posicion) {

        final Comments comment = this.comments.get(posicion);
        commentsViewHolder.author.setText(comment.getAuthor());
        commentsViewHolder.comment.setText(comment.getDescription());
        commentsViewHolder.date.setText(comment.getDate());
        commentsViewHolder.time.setText(comment.getTime());
        commentsViewHolder.email = comment.getEmail();
        commentsViewHolder.imageButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                context = v.getContext();
                email = comment.getEmail();
                date = comment.getDate();
                time = comment.getTime();
                popPap();
            }
        });
    }

    @Override
    public int getItemCount() {
        return comments.size();
    }

    public void popPap(){
        ((MainActivity)activity).newAlertDialog(this, AlertID.BANCOMMENT, message);
    }

    @Override
    public void PositiveResponse(AlertID alertID) {
        if(isPlace) {
            DBConnect.reportPlaceComment(context, this, idPlaceRoute, email, date, time);
        }
        else {
            DBConnect.reportRouteComment(context,this,idPlaceRoute,email,date,time);
        }
    }

    @Override
    public void NegativeResponse(AlertID alertID) {

    }

    @Override
    public void onErrorResponse(VolleyError error) {
        Toast.makeText(context, "Error" +error, Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onResponse(JSONObject response) {
        Toast.makeText(context, messageOk, Toast.LENGTH_SHORT).show();
    }

    public class CommentsViewHolder extends RecyclerView.ViewHolder{
        private TextView author;
        private String email;
        private TextView comment;
        private TextView date;
        private TextView time;
        private ImageButton imageButton;

        public CommentsViewHolder(@NonNull View itemView) {
            super(itemView);
            author = itemView.findViewById(R.id.author);
            comment = itemView.findViewById(R.id.comment);
            date = itemView.findViewById(R.id.date);
            time = itemView.findViewById(R.id.time);
            imageButton = itemView.findViewById(R.id.banButton);
        }
    }
}
