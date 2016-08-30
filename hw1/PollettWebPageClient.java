import java.io.*;
import java.net.Socket;

public class PollettWebPageClient {

    private static final String HOST = "www.cs.sjsu.edu";
    private static final int PORT = 80;

    private static Socket connect(String host, int port) {
        try {
            return new Socket(host, port);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return null;
    }

    private static boolean request(Socket socket, String path) {
        try {
            String getRequest = "GET " + path + " HTTP/1.1";
            String hostHeader = "Host: www.cs.sjsu.edu";
            OutputStream out = socket.getOutputStream();
            PrintWriter printWriter = new PrintWriter(out);
            printWriter.println(getRequest);
            printWriter.println(hostHeader);
            printWriter.println("");
            printWriter.flush();
            return true;
        } catch (Exception e) {
            e.printStackTrace();
        }
        return false;
    }

    private static void response(Socket socket) {
        try {
            InputStream in = socket.getInputStream();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(in));
            String line;
            while ((line = bufferedReader.readLine()) != null) {
                System.out.println(line);
            }
            bufferedReader.close();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        String path = "/faculty/pollett/";
        if (args.length != 0) {
            path += args[0];
            System.out.println(path);
        }
        Socket socket = connect(HOST, PORT);
        if (socket != null) {
            if (request(socket, path)) {
                response(socket);
            } else {
                System.out.println("Failed to make the GET request.");
            }
        } else {
            System.out.println("Failed to establish a connection to " + HOST + " with port " + PORT + ". Please try again.");
        }
    }
}
